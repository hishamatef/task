<?php

namespace Modules\SimpleForm\Traits;


trait EmailTrait {

    public static function sendEmail($subject,$body,$to_name,$to_email,$from_name,$from_email)
    {
        $mail = [];
        $mail['email_subject'] = $subject;
        $mail['email_body'] = $body;
        $mail['full_name'] = $to_name;
        $mail['email'] = $to_email;
        $mail['from_name'] = $from_name;
        $mail['from_email'] = $from_email;

        \Mail::send($mail, $mail, function ($message) use ($mail) {
            $message->to($mail['email'], $mail['full_name'])
                ->subject($mail['email_subject'])
                ->setBody($mail['email_body']);
            $message->from($mail['from_email'], $mail['from_name']);
        });
    }
}
