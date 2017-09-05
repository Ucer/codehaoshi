<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag', 'slug', 'description', 'style'
    ];

    /**
     * Get all of the articles that are assigned this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorpheByMany
     */
    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function questions()
    {
        return $this->morphedByMany(Question::class, 'taggable');
    }

}
