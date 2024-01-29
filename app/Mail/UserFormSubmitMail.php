<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserFormSubmitMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userEmail;
    public $name;

    /**
     * Create a new message instance.
     *
     * @param string $userEmail
     * @param string $name
     */
    public function __construct($userEmail, $name)
    {
        $this->userEmail = $userEmail;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.userformsubmit_mail')
            ->subject('Confirmation of Your Appointment Request');
    }
}
