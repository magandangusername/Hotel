<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookCompleteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $confirmation_number;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $confirmation_number)
    {
        $this->details = $details;
        $this->confirmation_number = $confirmation_number;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->subject('Booked Successfully!')->view('confdisplay');
    }
}
