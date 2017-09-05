<?php

namespace App\Tools;

use Naux\Mail\SendCloudTemplate;
use Mail;

class Mailer
{
    /**
     * @param $template
     * @param $email
     * @param array $data
     */
    protected function sendTo($template, $email, array $data)
    {
        $content = new SendCloudTemplate($template, $data);

        Mail::raw($content, function ($message) use ($email) {
            $message->from('18313852226@qq.com', 'Code好事');
            $message->to($email);
        });
    }
}