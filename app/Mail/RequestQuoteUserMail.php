<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestQuoteUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quote;

    public function __construct($quote)
    {
        $this->quote = $quote;
    }

    public function build()
    {
        return $this->subject('Thank you for your Quote Request')
                    ->view('emails.request_quote_user');
    }
}