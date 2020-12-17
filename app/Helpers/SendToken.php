<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class SendToken
{
   public static function send($receiver_email, $token,$link)
   {
      $data = [
         "link"=>$link,
         "token"=>$token,
         "email"=>$receiver_email
      ];
      Mail::send('mail', $data, function ($message) use($receiver_email) {
         $message->to($receiver_email, 'Password Reset')->subject('Email Verification');
         $message->from('support@shopdharan.com', 'Shop Dharan');
      });
   }
}
