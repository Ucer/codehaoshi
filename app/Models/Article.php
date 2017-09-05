<?php

namespace App\Models;

use App\Models\Traits\ArticleFilterable;
use Illuminate\Database\Eloquent\Model;
use App\Tools\Markdowner;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Article extends Model
{
    use SoftDeletes, ArticleFilterable, SearchableTrait;
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'title', 'category_id', 'user_id',
        'weight', 'is_excellent', 'is_hot', 'only_owner_can_see',
        'is_draft', 'slug', 'content', 'description', 'published_at'
    ];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'articles.slug' => 5,
            'articles.title' => 5,
            'articles.content' => 5,
            'articles.description' =>5,
        ],
    ];


    /**
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the category for the blog article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Set the title and the readable slug.
     *
     * @param $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if (!config('services.youdao.appKey') || !config('services.youdao.appSecret')) {
            $this->setUniqueSlug($value, str_random(7));
        } else {
            $this->setUniqueSlug(translug($value), '');
        }
    }

    /**
     * Set the unique slug.
     *
     * @param $value
     * @param $extra
     */
    public function setUniqueSlug($value, $extra)
    {
        $slug = str_slug($value . '-' . $extra);

        if (static::whereSlug($slug)->exists()) {
            $this->setUniqueSlug($slug, (int)$extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }

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


    public function getCommentsWithLimit($limit = 30, $order = 'created_at')
    {
        $pageName = 'page';
        // Default display the latest reply
        $latest_page = is_null(request($pageName)) ? ceil($this->comment_count / $limit) : 1;
        $query = $this->comments()->with('user');

        $query = ($order == 'vote_count') ? $query->orderBy('vote_count', 'desc') : $query->orderBy('created_at', 'asc');

        return $query->paginate($limit, ['*'], $pageName, $latest_page);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

}
