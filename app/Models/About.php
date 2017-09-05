<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Tools\Markdowner;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['title', 'content', 'is_enabled'];
    /**
     * @param $value
     */
    public function setContentAttribute($value)
    {
        $data = [
            'raw' => $value,
            'html' => (new Markdowner)->convertMarkdownToHtml($value)
        ];
        $this->attributes['content'] = json_encode($data);
    }
}
