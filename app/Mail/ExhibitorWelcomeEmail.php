<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExhibitorWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $booth;

    /**
     * Create a new message instance.
     *
     * @param string $booth
     */
    public function __construct($booth)
    {
        $this->booth = $booth;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.exhibitor-welcome')
                    ->subject('Welcome to Ph Tech Expo')
                    ->with(['booth' => $this->booth]);
    }
}
