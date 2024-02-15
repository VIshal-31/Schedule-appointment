<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userEmail;
    public $userName;
    public $id;
    public $category;
    public $service_name;
    public $date;
    public $service_start_time;
    public $service_end_time;


    /**
     * Create a new message instance.
     *
     * @param string $userEmail
     * @param string $name
     */
    public function __construct($id, $userEmail, $userName, $category, $service_name, $date, $service_start_time, $service_end_time)
    {
        $this->id = $id;
        $this->userEmail = $userEmail;
        $this->userName = $userName;
        $this->category = $category;
        $this->service_name = $service_name;
        $this->date = $date;
        $this->service_start_time = $service_start_time;
        $this->service_end_time = $service_end_time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.userConfimMail')
            ->subject('Confirmation of Your Appointment Request');
    }
}
