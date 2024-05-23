<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EscalateToServiceHeadMail extends Mailable
{
    use Queueable, SerializesModels;
    public $escalate;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($escalate)
    {
        $this->escalate=$escalate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Impex')
                    ->view('email.escalate_to_service')->with([
                        'data' => $this->escalate
                    ]);
    }
}
