<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->index()->comment('分类id');
            $table->integer('user_id')->unsigned()->comment('作者id');
            $table->integer('reply_count')->default(0)->index()->comment('评论数量');
            $table->integer('view_count')->unsigned()->default(0)->index()->comment('查看数量');
            $table->integer('vote_count')->default(0)->index()->comment('点赞数量');
            $table->integer('last_reply_user_id')->unsigned()->default(0)->index()->comment('最近一次回复者');
            $table->integer('weight')->default(50)->index()->comment('权重');
            $table->enum('is_excellent', ['yes', 'no'])->default('no')->index()->comment('是否是优秀问题');
            $table->enum('is_hot', ['yes', 'no'])->default('no')->index()->comment('是否是热门问题');
            $table->enum('only_owner_can_see', ['yes', 'no'])->default('no')->index()->comment('是否仅自己可见');
            $table->enum('is_draft', ['yes', 'no'])->default('no')->index()->comment('是否为草稿');
            $table->string('title')->index()->comment('标题');
            $table->string('slug')->unique()->comment('缩略标题');
            $table->text('content')->comment('问题内容');
            $table->string('description')->nullable()->comment('简单描述');
            $table->timestamp('published_at')->nullable()->index()->comment('发布时间');
            $table->timestamps();
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
        Schema::dropIfexists('questions');
    }
}
