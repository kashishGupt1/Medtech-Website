<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactDetails;

    /**
     * Create a new message instance.
     */
    public function __construct($contactDetails)
    {
        $this->contactDetails = $contactDetails;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject('New Contact Form Submission')
                    ->view('emails.contact_us_admin')
                    ->with('contactDetails', $this->contactDetails);
    }
}
