<?php

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $articles = factory(Article::class)->times(100)->make()->each(function ($article, $i) {
            $user_id = 1;
            if ($i < 20) {
                $category = 1;
            } elseif ($i < 40) {
                $category = 2;
            } elseif ($i < 60) {
                $category = 3;
            } else {
                $user_id = 2;
                $category = 4;
            }
            $article->user_id = $user_id;
            $article->category_id = $category;
            $article->is_excellent = rand(0, 1) ? 'yes' : 'no';
            $article->is_hot = rand(0, 1) ? 'yes' : 'no';
        });
        DB::table('articles')->insert($articles->toArray());
    }
}
