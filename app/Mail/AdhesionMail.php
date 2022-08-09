<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdhesionMail extends Mailable
{
    use Queueable, SerializesModels;
    public $adherant;


    /**
     * Create a new message instance.
     *
     * @return void
     */
   public function __construct($adherant){

        $this->adherant = $adherant;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->subject('Bienvenue dans le CTM-BENIN')->view('emails.adhesion');
    }
}
