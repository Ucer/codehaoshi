<?php

namespace APp\Codehaoshi\Handler;

use Illuminate\Support\Facades\Mail;
use Naux\Mail\SendCloudTemplate;

class BackupHandler
{
    public function send($notifications)
    {
        $data = [
            'info' => $notifications
        ];
        $template = new SendCloudTemplate('codehaoshi_notification', $data);//模板调用名称-zhihu_app_register

        Mail::raw($template, function ($message) {
            $message->from('18313852226@sina.cn', 'code 好事');

            $message->to('185429135@qq.com');//发给谁
        });
    }
}