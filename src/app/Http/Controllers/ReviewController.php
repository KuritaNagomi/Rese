<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($reservationId)
    {
        $reservation = Reservation::with('shop')->findOrFail($reservationId);

        if ($reservation->user_id !=Auth::id()){
            return redirect()->route('may_page');
        }

        return view('review_edit', compact('reservation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'string|max:1000',
        ]);

        $reservation = Reservation::findOrFail($request->reservation_id);

        if ($reservation->user_id != Auth::id()) {
            return redirect('review_edit');
        }

        Review::create([
            'user_id' => Auth::id(),
            'shop_id' => $reservation->shop_id,
            'reservation_id' => $reservation->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('my_page')->with('message', 'レビューが投稿されました');

    }
}
