<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;

class TagController extends Controller
{
    protected $tagRepository;
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository, TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
        $this->articleRepository = $articleRepository;
    }

    public function show($slug, $type = null)
    {
        $tag = $this->tagRepository->getTagInfoBySlug($slug);

        if (!$tag) abort(404);
        $articles = $tag->articles->take(15);
        $questions = $tag->questions->take(15);

        if($type)  return view('tags.show-question', compact('articles', 'tag', 'questions'));
        return view('tags.show-article', compact('articles', 'tag' ,'questions'));
    }
}
