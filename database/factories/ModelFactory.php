<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'city'                 => $faker->city,
        'user_name'            => $faker->userName,
        'is_admin'            => 'no',
        'github_name'          => $faker->userName,
        'company'              => $faker->userName,
        'personal_website'     => $faker->url,
        'introduction'         => $faker->sentence,
        'email'                => $faker->email,
        'password'       => $password ?: $password = bcrypt('secret'),
        'avatar'               => '/assets/dashboard/images/head_default.gif',
        'status'               => '1',
        'article_count'        => '0',
        'question_count'       => '0',
        'created_at'           => \Carbon\Carbon::now()
    ];
});


$factory->define(\App\Models\Article::class, function (Faker\Generator $faker) {
    $title = $faker->sentence(mt_rand(3,10));
    return [
        'last_comment_user_id' => 0,
        'slug'     => str_slug($title),
        'title'    => $title,
        'content'  => $faker->paragraph,
        'description' => $faker->sentence,
        'published_at'     => \Carbon\Carbon::now(),
        'created_at'        => \Carbon\Carbon::now(),
    ];
});


$factory->define(\App\Models\Question::class, function (Faker\Generator $faker) {
    $title = $faker->sentence(mt_rand(3,10));
    return [
        'last_reply_user_id' => 0,
        'slug'     => str_slug($title),
        'title'    => $title,
        'content'  => $faker->paragraph,
        'description' => $faker->sentence,
        'published_at'     => \Carbon\Carbon::now(),
        'created_at'        => \Carbon\Carbon::now(),
    ];
});
