<?php

namespace Codehaoshi\Stat;

use App\Repositories\ArticleCategoryRepository;
use App\Repositories\QuestionCategoryRepository;
use Cache;

class Stat
{
    protected $articleCategoryRepository;
    protected $questionCategoryRepository;
    const CACHE_KEY = 'site_stat';
    const CACHE_MINUTES = 10;

    public function __construct(ArticleCategoryRepository $articleCategoryRepository, QuestionCategoryRepository $questionCategoryRepository)
    {
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->questionCategoryRepository = $questionCategoryRepository;
    }

    public function getCategoryAndQuestion()
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_MINUTES, function () {
            $entity = new StatEntity();
            $entity->questionList = $this->questionCategoryRepository->getAllData('*', false);
            $entity->categoryList = $this->articleCategoryRepository->getAllData('*', false);
            $entity->categoryList->each(function($item, $key) {
                $item->recent_update = $item->articles()->max('created_at');
            });
            $entity->questionList->each(function($item, $key) {
                $item->recent_update = $item->questions()->max('created_at');
            });
            return $entity;
        });
    }
}