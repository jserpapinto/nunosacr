<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BuyWork extends Mailable
{
    use Queueable, SerializesModels;

    public $client_name;
    public $client_email;
    public $client_subject;
    public $client_message;
    public $work_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($req)
    {
        //
        $this->client_name = $req['name'];
        $this->client_email = $req['mail'];
        $this->client_subject = $req['subject'];
        $this->client_message = $req['message'];
        $this->work_name = $req['workName'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->client_email)->view('mail.buyWork');
    }
}
