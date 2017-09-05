<?php

namespace App\Providers;

use App\Models\Link;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CommonDataServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('authUser', \Auth::user());
            $categoryAndQuestions = app('Codehaoshi\Stat\Stat')->getCategoryAndQuestion();
            $view->with('categoryList', $categoryAndQuestions->categoryList);
            $view->with('questionCategoryList', $categoryAndQuestions->questionList);

            $view->with('linkList',Link::where('is_enabled' , 'yes')->where('type', 'link')->get());
            $view->with('recommendList',Link::where('is_enabled' , 'yes')->where('type', 'recommend')->get());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
