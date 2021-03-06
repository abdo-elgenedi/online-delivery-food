<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlockedVendorMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $vendor;
    public function __construct($data)
    {
        $this->vendor=$data;
        $this->from=[0=>['address'=>emailAddress(),'name'=>emailName()]];
        $this->subject='Account Blocked';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $vendor=$this->vendor;
        return $this->view('emails.blockedvendor',compact('vendor'));
    }
}
