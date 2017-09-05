<?php
namespace App\Tools;
use Auth;

/**
 * Class UserMailer
 * @package App\Mailer
 */
class UserMailer extends Mailer
{
    /**
     * @param $email
     * @param $token
     */
    public function passwordReset($email, $token)
    {
        $data = ['url' => url('password/reset', $token)];

        $this->sendTo('codehaoshi_password_reset', $email, $data);
    }
}
