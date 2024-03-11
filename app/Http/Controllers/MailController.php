<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactMail;

class MailController extends Controller
{
    public function index(){
      $data=[
          'title' => 'Mail from skiptotrace',
          'body' => 'this is test mail',
      ];
      Mail::to('singhneha1001@gmail.com')->send(new ContactMail($data));

      dd("Email send successfully");
    }

}
