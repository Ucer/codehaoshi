<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name')->nullable()->unique()->comment('用户名')->index();
            $table->string('nickname')->nullable()->comment('昵称')->index();
            $table->string('email')->nullable()->unique()->comment('email');
            $table->text('avatar')->nullable()->comment('头像');
            $table->string('password')->nullable()->comment('密码');
            $table->tinyInteger('status')->default(0)->comment('用户状态：0禁用，1启用');
            $table->enum('is_admin', ['yes','no'])->default('no')->index()->comment('是否为后台管理员：no 否，yes 是');
            $table->string('city')->nullable()->comment('城市');
            $table->string('company')->nullable()->comment('公司');
            $table->string('personal_website')->nullable()->comment('个人网站');
            $table->string('introduction')->nullable()->comment('个人介绍');
            $table->integer('notification_count')->default(0)->comment('通告消息数量');
            $table->integer('article_count')->default(0)->index()->comment('发布的文章数量');
            $table->integer('question_count')->default(0)->index()->comment('发布的问题数量');
            $table->integer('follower_count')->default(0)->index()->comment('粉丝数量');
            $table->integer('comment_count')->default(0)->index()->comment('评论的文章数量');
            $table->integer('reply_count')->default(0)->index()->comment('评论的问题数量');
            $table->integer('github_id')->nullable()->index();
            $table->string('github_name')->nullable()->index();
            $table->string('image_url')->nullable();
            $table->string('register_source')->nullable()->index();
            $table->string('remember_token')->nullable();
            $table->string('login_token')->nullable()->comment('登录 token');
            $table->string('verification_token')->nullable();
            $table->timestamp('last_actived_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
