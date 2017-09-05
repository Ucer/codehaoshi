<?php

namespace Codehaoshi\Selectors;

use App\Repositories\ArticleRepository;
use App\Repositories\QuestionRepository;

class QuestionSelector
{
    protected  $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }
    public function questionInfoWithPrevAndNext($id)
    {

        return [
            'prev' => $this->questionRepository->getByIdWithoutException($id, '<'),
            'next' => $this->questionRepository->getByIdWithoutException($id , '>'),
        ];

    }
}