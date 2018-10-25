<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailDispo extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email_modif_statut')->with([
            'name' => $this->data['name'],
            'last_name'     => $this->data['last_name'],
            'bodyMessage'   => 'a changé son statut. Ce message vous est envoyé depuis le site dispo.me : http://www.dispo.me',
            'email'         => 'contact@dispo.me',
            'slug'          =>  $this->data['slug']
        ]);
    }
}
