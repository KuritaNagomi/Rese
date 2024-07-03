<?php

namespace App\Http\Controllers;

use App\Mail\CustomEmail;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShopManagerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $genres = Genre::all();
        $areas = Area::all();

        $shops = Shop::where('manager_id', $user->id)->get();

        $reservations = Reservation::whereIn('shop_id', $shops->pluck('id'))->orderBy('start_at')->get();

        $shop = $shops->first();

        return view('admin.shop_manager',compact('genres', 'areas', 'reservations', 'shops', 'shop'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'area_id' => 'required|exists:areas,id',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shop = new Shop;
        $shop->name = $request->name;
        $shop->genre_id = $request->genre_id;
        $shop->area_id = $request->area_id;
        $shop->description = $request->description;
        $shop->manager_id = Auth::id();

        if ($request->file('image')){
            $imagePath = $request->file('image')->store('shop_images', 'public');
            $shop->image_url = Storage::url($imagePath);
        }

        $shop->save();

        return redirect()->route('shop_manager.index')->with ('message', '店舗を作成しました');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'string|max:255',
            'area' => 'string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shop = Shop::findOrFail($id);
        $shop->name = $request->input('name');
        $shop->genre_id = $request->input('genre_id');
        $shop->area_id = $request->input('area_id');
        $shop->description = $request->input('description');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('shop_images', 'public');
            $shop->image_url = Storage::url($imagePath);
        }
        else {
            $shop->image_url = $request->input('current_image');
        }

        $shop->save();

        return redirect()->route('shop_manager.index')->with('message', '店舗情報が更新されました');
    }

    public function showForm($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.email', compact('user'));
    }

    public function sendEmail(Request $request, $userId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $user = User::findOrFail($userId);

        \Mail::to($user->email)->send(new CustomEmail($request->input('subject'), $request->input('message')));

        return redirect()->route('shop_manager.index')->with('message', 'メールを送信しました');
    }

}
