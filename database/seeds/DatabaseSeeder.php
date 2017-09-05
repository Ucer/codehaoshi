<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        $this->call(ArticleCategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);

        $this->call(QuestionCategoriesTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);

        $this->call(TaggablesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
    }
}
