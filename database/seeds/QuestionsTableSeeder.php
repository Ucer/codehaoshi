<?php

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $questions = factory(Question::class)->times(100)->make()->each(function ($question, $i) {
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
            $question->user_id = $user_id;
            $question->category_id = $category;
            $question->is_excellent = rand(0, 1) ? 'yes' : 'no';
            $question->is_hot = rand(0, 1) ? 'yes' : 'no';
        });
        DB::table('questions')->insert($questions->toArray());
    }
}
