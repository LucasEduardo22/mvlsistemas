<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newUsuarios extends Mailable
{
    use Queueable, SerializesModels;

    protected $nova_senha;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nova_senha)
    {
        $this->nova_senha = $nova_senha;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$this->subject("Ola Bem vindo ao MVL Sistemas");
        $dados =  $this->nova_senha;
 
        return $this->view('admin.email.novo-usuario', compact('dados'));
    }
}
