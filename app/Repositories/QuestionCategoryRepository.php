<?php

namespace App\Repositories;


use App\Models\QuestionCategory;

class QuestionCategoryRepository
{
    use BaseRepository;
    protected $model;

    public function __construct(QuestionCategory $questionCategory)
    {
        $this->model = $questionCategory;
    }


    public function getInfoBySlug($slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }
}