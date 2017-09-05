<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Repositories\ArticleRepository;
use App\Repositories\QuestionCategoryRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\TagRepository;
use App\Tools\FileManager\BaseManager;
use Codehaoshi\Selectors\QuestionSelector;
use Auth;

class QuestionsController extends Controller
{
    protected $questionCategoryRepository;
    protected $articleRepository;
    protected $questionRepository;
    protected $tagRepository;

    public function __construct(QuestionCategoryRepository $questionCategoryRepository, QuestionRepository $questionRepository, TagRepository $tagRepository, ArticleRepository $articleRepository)
    {
        $this->questionCategoryRepository = $questionCategoryRepository;
        $this->questionRepository = $questionRepository;
        $this->tagRepository = $tagRepository;
        $this->articleRepository = $articleRepository;
    }


    /**
     * Show article-info page
     * @param $slug
     * @param Article $articleModel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug, Question $questionModel)
    {
        $question = $this->questionRepository->getQuestionInfoBySlug($slug);
        //sdfsadf
        if ($question->is_draft == 'yes' || $question->only_owner_can_see == 'yes') {
            $this->authorize('showDraft', $question);
        }

        $question->increment('view_count');

        $recentQuestions = $questionModel->withoutDraft()->withoutPrivate()->where('id', '<>', $question['id'])->orderBy('created_at', 'desc')->select('id', 'title', 'slug')->paginate(6);

        $prevAndNext = app(QuestionSelector::class)->questionInfoWithPrevAndNext($question->id);
        return view('questions.show', ['info' => $question,
            'recentQuestions' => $recentQuestions,
            'prev' => $prevAndNext['prev'],
            'next' => $prevAndNext['next']
        ]);
    }

    /**
     * Get article list by category
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($slug)
    {
        $category = $this->questionCategoryRepository->getInfoBySlug($slug);
        $questions = $this->questionRepository->getThisModel()->getArticlesWithFilter('category', 20, $category->id);

        $hotQuestions = $this->questionRepository->getThisModel()->getArticlesWithFilter('hot', 5);
        $recentQuestions = $this->questionRepository->getThisModel()->getArticlesWithFilter('recent', 5);
        $tags = $this->tagRepository->getAllTagWithCount();
        return view('questions.question-list', compact('questions', 'category', 'hotQuestions', 'recentQuestions', 'tags'));
    }

    /**
     * Get All articles
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allQuestions()
    {
        $questions = $this->questionRepository->getThisModel()->getArticlesWithFilter('recent', 20);
        return view('questions.all-questions', compact('questions'));
    }

    public function create()
    {
        $recentArticles = $this->articleRepository->getThisModel()->getArticlesWithFilter('recent', 5);
        $recentQuestions = $this->questionRepository->getThisModel()->getArticlesWithFilter('recent', 5);
        $tags = $this->tagRepository->getAllTagWithCount();

        $catList = $this->questionCategoryRepository->getAllData(['id', 'name'], false);
        $tagList = $this->tagRepository->getAllData(['id', 'tag'], false);
        return view('questions.create', compact('tagList', 'catList', 'recentQuestions', 'recentArticles', 'tags'));
    }

    public function store(QuestionRequest $request)
    {
        $data = array_merge($request->all(), ['user_id' => Auth::id()]);
        $res  =$this->questionRepository->store($data);

        $this->questionCategoryRepository->getById($request->category_id)->increment('question_count');
        Auth::user()->increment('question_count');

        $this->questionRepository->syncTag(explode(',', $request->tags));
        flash('info', '问题发布成功');
        return redirect()->route('question.show', ['slug' => $res->slug]);
    }

    public function uploadImage(ImageUploadRequest $request)
    {
        if ($file = $request->file('file')) {
            try {
                $upload_status = app(BaseManager::class)->storeUploadImgByConfigPath($file, 'front_images');
            } catch (\Exception $exception) {
                return ['error' => $exception->getMessage()];
            }
            $data['filename'] = $upload_status['url'];

        } else {
            $data['error'] = 'Error while uploading file';
        }
        return $data;
    }

    public function edit($id)
    {
        $recentArticles = $this->articleRepository->getThisModel()->getArticlesWithFilter('recent', 5);
        $recentQuestions = $this->questionRepository->getThisModel()->getArticlesWithFilter('recent', 5);
        $tags = $this->tagRepository->getAllTagWithCount();

        $catList = $this->questionCategoryRepository->getAllData(['id', 'name'], false);
        $tagList = $this->tagRepository->getAllData(['id', 'tag'], false);
        $info = $this->questionRepository->getById($id);
        $infoTag = implode(',', array_column($info->tags->toArray(), 'id'));

        return view('questions.edit',compact('info','infoTag', 'catList', 'tagList', 'tags', 'recentArticles', 'recentQuestions'));
    }

    public function update(QuestionRequest $request, $id)
    {
        $oldData = $this->questionRepository->getById($id)->category_id;
        if ($oldData != $request->category_id) {
            $this->questionCategoryRepository->getById($request->category_id)->increment('question_count');
            $this->questionCategoryRepository->getById($oldData)->decrement('question_count');
        }
        $data = $request->only('title', 'category_id', 'description', 'content', 'tags', 'is_draft', 'slug');
        $res = $this->questionRepository->update($id, $data);

        $this->questionRepository->syncTag(explode(',', $request->tags));
        flash('info', '问题更新成功');
        return redirect()->route('question.show', ['slug' => $res->slug]);
    }
}
