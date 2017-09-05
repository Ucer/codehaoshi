<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Question;

class TaggablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $article_ids = Article::pluck('id')->toArray();
        $question_ids = Question::pluck('id')->toArray();
        foreach ($article_ids as $article_id) {
         Article::findOrFail($article_id)->tags()->sync([rand(1,2),rand(3,4)]);
        }
        foreach ($question_ids as $question_id) {
            Question::findOrFail($question_id)->tags()->sync([rand(1,2),rand(3,4)]);
        }
    }
}
