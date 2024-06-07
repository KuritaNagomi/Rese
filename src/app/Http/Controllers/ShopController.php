<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with(['area', 'genre'])->get();
        $areas = Area::all();
        $genres = Genre::all();

        $favorite = [];
        if(Auth::check()){
            $user = Auth::user();
            $favorite = $user->favorites()->pluck('shop_id')->toArray();
        } else {
            $favorite = [];
        }

        return view('index', compact('shops', 'areas', 'genres', 'favorite'));
    }

    public function search(Request $request)
    {
        $query = Shop::query();

        $query = $this->getSearchQuery($request, $query);

        $shops = $query->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('index', compact('shops' ,'areas','genres'));
    }

    public function detail($id)
    {
        $shop = Shop::with(['area', 'genre'])->findOrFail($id);
        return view('detail', compact('shop'));

    }

    private function getSearchQuery($request, $query)
    {
        if(!empty($request->keyword)){
            $query->where(function ($q) use ($request){
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }
        if(!empty($request->area)){
            $query->where('area_id', '=', $request->area);
        }
        if(!empty($request->genre)){
            $query->where('genre_id', '=', $request->genre);
        }
        return $query;
    }
}
