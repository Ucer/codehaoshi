<?php

namespace App\Models;

use App\Models\Traits\BaseFilterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use SoftDeletes,BaseFilterable,Notifiable;

    protected $fillable = [
        'body',
        'user_id',
        'article_id',
        'body_original',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

