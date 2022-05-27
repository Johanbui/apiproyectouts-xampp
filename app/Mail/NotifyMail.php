<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $params;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params, $asunto)
    {
        $this->params = $params;
        $this->subject = $asunto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.emailProyecto');
    }
}
