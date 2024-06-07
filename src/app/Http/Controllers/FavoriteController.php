<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $user = Auth::user();
        $shopId = $request->input('shop_id');

        $favorite = Favorite::where('user_id', $user->id)->where('shop_id', $shopId)->first();

        if($favorite){
            $favorite->delete();
        } else {
            Favorite::create(['user_id' => $user->id, 'shop_id' => $shopId]);
        }

        return redirect()->back();
    }
}
