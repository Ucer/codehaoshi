<?php

namespace App\Repositories;



use App\Models\About;

class AboutRepository
{
    use BaseRepository;
    protected $model;

    public function __construct(About $about)
    {
        $this->model = $about;
    }
}