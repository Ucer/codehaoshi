<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ArticleCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_categories')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'parent_id' => 0,
                    'name' => 'php',
                    'slug' => 'php',
                    'weight' => '50',
                    'article_count' => '20',
                    'description' => 'php 从入门到放弃的坑坑记录，解析为什么 php 是世界上最好的语言。',
                    'image_url' => '/images/article-cat.png',
                    'style' => 'violet',
                    'created_at' => Carbon::now(),
                ),
            1 =>
                array(
                    'id' => 2,
                    'parent_id' => 0,
                    'name' => 'python',
                    'slug' => 'python',
                    'weight' => '50',
                    'article_count' => '20',
                    'description' => 'python 从入门到放弃的坑坑记录，目录很流行的弱类型语言，能干好多事情。',
                    'image_url' => '/images/article-cat.png',
                    'style' => 'teal',
                    'created_at' => Carbon::now(),
                ),
            2 =>
                array(
                    'id' => 3,
                    'parent_id' => 0,
                    'name' => 'linux',
                    'slug' => 'linux',
                    'weight' => '50',
                    'article_count' => '20',
                    'description' => 'linux Os ，很强大的一个操作系统，web 开发者必备技能。',
                    'image_url' => '/images/article-cat.png',
                    'style' => 'green',
                    'created_at' => Carbon::now(),
                ),
            3 =>
                array(
                    'id' => 4,
                    'parent_id' => 0,
                    'name' => '开发者工具',
                    'slug' => 'tools',
                    'weight' => '50',
                    'article_count' => '40',
                    'description' => '开发中经常用到的各种工具，如 Ide、svn、git 等等。',
                    'image_url' => '/images/article-cat.png',
                    'style' => 'red',
                    'created_at' => Carbon::now(),
                )
        ));
    }
}
