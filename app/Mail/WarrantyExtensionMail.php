<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WarrantyExtensionMail extends Mailable
{
    use Queueable, SerializesModels;
    public $extension;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($extension)
    {
        $this->extension=$extension;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Impex')
                    ->view('email.warranty_extension')->with([
                        'data' => $this->extension
                    ]);
    }
}
