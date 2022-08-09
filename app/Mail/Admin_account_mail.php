<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Admin_account_mail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $non_hash_password;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$non_hash_password){

        $this->user = $user;
        $this->non_hash_password = $non_hash_password;



    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->subject('Compte Administrateur créé avec succès 🎉')->view('emails.createaccount');
    }
}

