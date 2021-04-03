<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return WelcomeMessage|array|string|string[]
     */
    public function build()
    {
        return $this->from('phreactive@team.com','PHReactive')
            ->subject('Welcome!')
            ->markdown('welcome')
            ->with([
                'name' => 'New User'
            ]);
    }
}
