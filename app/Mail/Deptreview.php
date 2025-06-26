<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Deptreview extends Mailable
{
    use Queueable, SerializesModels;

    public $customSubject;
    public $customBody;
    public $username;
    public $password;
    public $userfullname;
    /**
     * Create a new message instance.
     */
    public function __construct($customSubject, $customBody, $username, $password,$userfullname)
    {
        // $this->details = $details;
        $this->username = $username;
        $this->customSubject = $customSubject;
        $this->customBody = $customBody;
        $this->password = $password; // Assign the password
        $this->userfullname = $userfullname;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // return $this->subject($this->details['subject'])
        //             ->view('emails.bulk');
        // dd($this->password);
        return $this->view('backend.masteradmin.email.bulkmail')
        ->subject($this->customSubject)
        ->with([
            'user' => $this->username,
            'body' => $this->customBody,
            'password' => $this->password, // Pass the password
            'fullname' => $this->userfullname
        ]);
    }
}

