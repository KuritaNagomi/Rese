<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;

class ReservationController extends Controller
{
    public function confirm(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }

        $reservation = $request->all();

        $shop_id = $reservation['shop_id'];

        $shop = Shop::with(['area', 'genre'])->findOrFail($shop_id);

        return view('confirm', compact('reservation', 'shop'));
    }

    public function store(Request $request)
    {
        $date = $request->input('date');
        $time = $request->input('time');

        $startAt = $date . ' ' . $time;

        $userId = Auth::id();

        $data = $request->only([
            'shop_id',
            'num_of_users'
        ]);

        $data['user_id'] = $userId;
        $data['start_at'] = $startAt;

        Reservation::create($data);

        return view('done');
    }

    public function destroy(Request $request)
    {
        Reservation::find($request->id)->delete();

        return redirect('my_page');
    }
}
