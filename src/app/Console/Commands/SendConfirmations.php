<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ConfirmationEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendConfirmations extends Command
{

    protected $signature = 'send:confirmations';

    protected $description = 'Send confirmation emails to users for today\'s reservations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $reservations = Reservation::whereDate('start_at', Carbon::today())->get();

        foreach ($reservations as $reservation){
            $user = $reservation->user;

            Mail::to($user->email)->send(new ConfirmationEmail($user, $reservation));
        }

        $this->info('Confirmation emails sent successfully!');
    }
}
