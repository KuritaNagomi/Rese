<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;

    public function __construct($subject, $messageData)
    {
        $this->subject = $subject;
        $this->messageData = $messageData;
    }

    public function build()
    {
        return $this->view('email.custom')
                    ->subject($this->subject)
                    ->with(['messageData' => $this->messageData,]);
    }
}
