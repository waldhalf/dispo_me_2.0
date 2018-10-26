<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Sichikawa\LaravelSendgridDriver\SendGrid;

class EmailDispo extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    use SendGrid;
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
        // return $this->view('email_modif_statut')->with([
        //     'name' => $this->data['name'],
        //     'last_name'     => $this->data['last_name'],
        //     'bodyMessage'   => 'a changé son statut. Ce message vous est envoyé depuis le site dispo.me : http://www.dispo.me',
        //     'email'         => 'contact@dispo.me',
        //     'slug'          =>  $this->data['slug']
        // ]);
        // return $this->view('test_mail');
    //     $address = 'janeexampexample@example.com';
    //     $subject = 'This is a demo!';
    //     $name = 'Jane Doe';
    //     error_log ('coucou est moi3');
    //     return $this->view('test_mail')
    //                 ->from($address, $name)
    //                 ->cc($address, $name)    
    //                 ->replyTo($address, $name)
    //                 ->subject($subject)
    //                 ->with([ 'message' => $this->data['bodyMessage']]);
    // return $this
    // ->view('test_mail')
    // ->subject('subject')
    // ->from('from@example.com')
    // ->to(['rem@magic.fr'])
    // ->sendgrid([
    //     'personalizations' => [
    //         [
    //             'substitutions' => [
    //                 ':myname' => 's-ichikawa',
    //             ],
    //         ],
    //     ],
    // ]);
    }
}
