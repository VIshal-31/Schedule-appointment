<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminFormSubmitMail extends Mailable
{
    use Queueable, SerializesModels;

    public $adminEmail;
    public $name;

    /**
     * Create a new message instance.
     *
     * @param string $adminEmail
     * @param string $name
     */
    public function __construct($adminEmail, $name)
    {
        $this->adminEmail = $adminEmail;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.adminformsubmit_mail')
            ->subject('New Appointment Requests');
    }
}
