<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Shop;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ReservationController extends Controller
{
    public function confirm(ReservationRequest $request)
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

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id != Auth::id()){
            return redirect()->route('my_page');
        }

        $shop_id = $reservation['shop_id'];

        $shop = Shop::with(['area', 'genre'])->findOrFail($shop_id);

        return view('edit', compact('reservation', 'shop'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id != Auth::id()){
            return redirect()->route('my_page');
        }

        $date = $request->input('date');
        $time = $request->input('time');

        $startAt = $date . ' ' . $time;

        $reservation->update([
            'start_at' => $startAt,
            'num_of_users' => $request->input('num_of_users'),
        ]);

        return redirect()->route('my_page');

    }

    public function destroy(Request $request)
    {
        Reservation::find($request->id)->delete();

        return redirect('my_page');
    }

    public function show($id)
    {
        $reservation = Reservation::with('user', 'shop')->findOrFail($id);

        $shopName = $reservation->shop->name;
        $userName = $reservation->user->name;
        $startTime = $reservation->start_at;
        $numOfUsers = $reservation->num_of_users;

        $qrCodeContent = "Reservation ID: $id\nShop: $shopName\nUser: $userName\nStart Time: $startTime\nNumber of Users: $numOfUsers";
        $qrCode = QrCode::encoding('UTF-8')->size(400)->generate($qrCodeContent);

        return view('reservations.show_qr', [
            'qrCode' => $qrCode,
            'reservation' => $reservation,
            'shopName' => $shopName,
            'userName' => $userName,
            'startTime' => $startTime,
            'numOfUsers' => $numOfUsers,
        ]);
    }

}
