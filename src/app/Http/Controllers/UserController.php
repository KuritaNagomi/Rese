<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Shop;

class UserController extends Controller
{
    public function myPage()
    {
        $user = Auth::user();
        $userId = Auth::id();

        $reservations = Reservation::where('user_id', $userId)
        ->with('shop')
        ->orderBy('start_at', 'asc')
        ->get();

        $favoriteShopIds = $user->favorites()->pluck('shop_id')->toArray();
        $favoriteShops = Shop::whereIn('id', $favoriteShopIds)->get();

        return view('my_page', compact('reservations', 'favoriteShops'));
    }

}
