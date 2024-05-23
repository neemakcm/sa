<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BussinessEnguiryMail extends Mailable
{
    use Queueable, SerializesModels;
    public $enquiry;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($enquiry)
    {
        $this->enquiry=$enquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Impex')
                    ->view('email.bussiness_enquiry')->with([
                        'enquiry' => $this->enquiry
                    ]);
        // return $this->view('view.name');
    }
}
