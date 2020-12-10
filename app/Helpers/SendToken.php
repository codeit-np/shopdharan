<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

Class SendToken{
    public static function send($receiver_email, $token){
        $data = array('token'=>$token);
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to($receiver_email, 'Password Reset')->subject
            ('Email Verification');
         $message->from('support@shopdharan.com','Shop Dharan');
      });
      echo "Basic Email Sent. Check your inbox.";
    }
}