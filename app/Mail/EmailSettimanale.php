<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Mail\EmailSettimanale;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSettimanale extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome)
    {
         $this->nome = $nome;
         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nome = $this->nome;
        return $this->view("mails.emailSettimanale")->with(compact('nome'));

    }
}
