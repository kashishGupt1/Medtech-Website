<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactDetails;

    public function __construct($contactDetails)
    {
        $this->contactDetails = $contactDetails;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject('Thank You For Contact Us')
                    ->view('emails.contact_us_user');
                    
    }
}