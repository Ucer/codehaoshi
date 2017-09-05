<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(49)->make()->each(function ($user, $i) {
            if ($i == 0) {
                $user->user_name = 'Ucers';
                $user->is_admin = 'yes';
                $user->email = 'ucer@codehaohsi.com';
                $user->password = bcrypt('111111');
                $user->article_count = 60;
                $user->question_count = 60;
            }
            if ($i == 1) {
                $user->user_name = 'Hello';
                $user->is_admin = 'yes';
                $user->email = 'hello@codehaohsi.com';
                $user->password = bcrypt('111111');
                $user->article_count = 40;
                $user->question_count = 40;
            }
            $user->github_id = $i + 1;
        });
        DB::table('users')->insert($users->toArray());

        $supper_admin = (new RoleRepository(new Role))->store(['name' => 'supper_admin', 'display_name' => '超级管理员', 'description' => '拥有最高管理权限']);
        User::findOrFail(1)->attachRole($supper_admin);
    }
}
