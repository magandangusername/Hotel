<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancellationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $amount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Cancellation Successful!')->view('admin.cancellationemail');
    }
}
