<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // mailtype : 1 = welcome/registration, 2 = trial class booking, 3 = trial class confirmed, 4 = enrollment
        if($this->details['mailtype'] == 1)
            return $this->view('emails.welcome')
            ->subject('Welcome Onboard')
                    ->with([
                        'user_name' => $this->details['name'],
                        'user_mobile' => $this->details['mobile'],
                        'user_password' => $this->details['password'],
                    ]);

        if($this->details['mailtype'] == 2)
                    return $this->view('emails.trialbooked')
                    ->subject('Trial Class Booked Successfully!')
                    ->with([
                    'user_name' => $this->details['name'],
                    'slot_1' => $this->details['slot_1'],
                    'slot_2' => $this->details['slot_2'],
                    'slot_3' => $this->details['slot_3'],
                    'tutor_name' => $this->details['tutor_name'],
                    ]);
        if($this->details['mailtype'] == 3)
                    return $this->view('emails.trialconfirmed')
                    ->subject('Trial Class Confirmed!')
                    ->with([
                    'user_name' => $this->details['name'],
                    'confirmed_slot' => $this->details['confirmed_slot'],
                    'tutor_name' => $this->details['tutor_name'],
                    ]);
        if($this->details['mailtype'] == 4)
                    return $this->view('emails.enrolled')
                    ->subject('Enrollment Successfull!')
                    ->with([
                    'user_name' => $this->details['name'],
                    'total_classes' => $this->details['total_classes'],
                    'tutor_name' => $this->details['tutor_name'],
                    ]);

    }
}
