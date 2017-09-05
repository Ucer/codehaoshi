<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            0 =>
                array(
                    'name' => 'supper_admin',
                    'display_name' => '超级管理员',
                    'description' => '拥有最高管理权限'
                ),
            1 =>
                array(
                    'name' => 'article_manager',
                    'display_name' => '文章管理员',
                    'description' => '拥有文章的管理权限'
                ),
            2 =>
                array(
                    'name' => 'question_manager',
                    'display_name' => '问题管理员',
                    'description' => '拥有问题管理权限'
                ),
        ));
    }
}
