<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(array(
            0 =>
                array(
                    'name' => 'edit_article',
                    'display_name' => '编辑文章',
                    'description' => '编辑文章-CU'
                ),
            1 =>
                array(
                    'name' => 'edit_question',
                    'display_name' => '编辑问题',
                    'description' => '编辑问题-CU'
                ),
            2 =>
                array(
                    'name' => 'handle_abouts',
                    'display_name' => '关于我们作者',
                    'description' => '可编辑关于我们'
                ),
        ));
    }
}
