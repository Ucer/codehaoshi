<?php

namespace App\Repositories;

use App\Models\Tag;
use DB;

class TagRepository
{
    use BaseRepository;
    protected $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * get All tags with used count as weight
     */
    public function getAllTagWithCount()
    {
        $tags = $this->all();
        $tags = $tags->each( function ($item, $key) {
            $item->weight = DB::table('taggables')->where('tag_id', '=', $item->id)->count();
        });
        return $tags;
    }


    public function getTagInfoBySlug($slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

}