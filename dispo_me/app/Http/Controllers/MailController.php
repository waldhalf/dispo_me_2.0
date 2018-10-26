<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmailDispo;
use Mail;

class MailController extends Controller
{
    public static function sendMail() {
        Mail:to('rem@magic.fr')->send(new EmailDispo());
        dd('mail sent');
    }
}
