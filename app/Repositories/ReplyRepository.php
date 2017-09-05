<?php

namespace App\Repositories;


use App\Models\Reply;

class ReplyRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Reply $comment)
    {
        $this->model = $comment;
    }
}