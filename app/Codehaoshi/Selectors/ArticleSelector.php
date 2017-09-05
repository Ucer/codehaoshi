<?php

namespace Codehaoshi\Selectors;

use App\Repositories\ArticleRepository;

class ArticleSelector
{
    protected  $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }
    public function articleInfoWithPrevAndNext($id)
    {

        return [
            'prev' => $this->articleRepository->getByIdWithoutException($id, '<'),
            'next' => $this->articleRepository->getByIdWithoutException($id , '>'),
        ];

    }
}