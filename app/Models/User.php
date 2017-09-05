<?php

namespace App\Models;

use App\Models\Traits\FollowerHelper;
use App\Models\Traits\UserAvatorHelper;
use App\Tools\UserMailer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Ucer\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, UserAvatorHelper,FollowerHelper;
    use EntrustUserTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email',
        'city',
        'introduction',
        'password', 'image_url',
        'github_id', 'github_name',
        'nickname', 'register_source',
        'status', 'last_actived_at', 'is_admin',
        'company', 'personal_website',
        'avatar'
    ];
    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * send password reset email to user's email base on token.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        (new UserMailer)->passwordReset($this->email, $token);
    }

    public function saveFunction()
    {
        $user = $this->findOrFail(6);

//        $user->attachRole(6); // 为用户 1 添加两1身份
        $user->attachRoles(['1', '2']); // 为用户 1 添加两个身份

//        $user->detachRole(1); // 移除用户1的1身份
//        $user->detachRoles(); // 移除用户1的所有身份

        $result = 'success';
//        $result = $user->hasRole(['admin','owner']); // 不加第二个参数，只匹配数组中的第一个身份:w
//         $result = $user->hasRole(['admin','owner','hellow'],true); // 加 ture 参数 后要完全匹配
//        $result = $user->hasRole('admin');
//        $result = $user->can('edit-user');
//        $result = $user->ability(array('admin', 'owner'), array('create-post', 'edit-user'));

        return $result;
    }
}
