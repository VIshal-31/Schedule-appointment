<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminFormSubmitMail extends Mailable
{
    use Queueable, SerializesModels;

    public $adminEmail;
    public $userEmail;
    public $id;
    public $userName;
    public $category;
    public $service_name;
    public $date;
    public $service_start_time;
    public $service_end_time;

    /**
     * Create a new message instance.
     *
     * @param string $adminEmail
     * @param string $name
     */
    public function __construct($adminEmail, $id, $userEmail, $userName, $category, $service_name, $date, $service_start_time, $service_end_time)
    {
        $this->adminEmail = $adminEmail;
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
        return $this->view('emails.adminformsubmit_mail')
            ->subject('New Appointment Requests');
    }
}
