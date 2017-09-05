<?php

namespace App\Repositories;

use App\Models\ArticleCategory;

class ArticleCategoryRepository
{
    use BaseRepository;
    protected $model;

    public function __construct(ArticleCategory $articleCategory)
    {
        $this->model = $articleCategory;
    }


    public function getInfoBySlug($slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }
}