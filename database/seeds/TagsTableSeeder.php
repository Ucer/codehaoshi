<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert(array(
                0 => array(
                    'id' => 1,
                    'tag' => 'jquery',
                    'slug' => 'jquery',
                    'description' => 'jquery，web 开发者必备技能。',
                    'style' => 'green',
                    'created_at' => Carbon::now(),
                ),
                1 => array(
                    'id' => 2,
                    'tag' => 'nginx',
                    'slug' => 'nginx',
                    'description' => 'nginx，比 Apache 强大百倍的超强 web 服务器。',
                    'style' => 'red',
                    'created_at' => Carbon::now(),
                ),
                2 => array(
                    'id' => 3,
                    'tag' => 'es6',
                    'slug' => 'es6',
                    'description' => '学习 vue.js 的前置技能',
                    'style' => 'violet',
                    'created_at' => Carbon::now(),
                ),
                3 => array(
                    'id' => 4,
                    'tag' => 'vue',
                    'slug' => 'vue',
                    'description' => '现在最热门的 js 框架',
                    'style' => 'teal',
                    'created_at' => Carbon::now(),
                ),
            )
        );
    }
}
