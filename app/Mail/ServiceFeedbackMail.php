<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceFeedbackMail extends Mailable
{
    use Queueable, SerializesModels;
    public $feedback;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($feedback)
    {
        $this->feedback=$feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Impex')
                    ->view('email.service_feedback')->with([
                        'data' => $this->feedback
                    ]);
    }
}
