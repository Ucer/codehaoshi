<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
}