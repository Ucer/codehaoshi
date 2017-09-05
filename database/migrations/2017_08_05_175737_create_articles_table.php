<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->index()->comment('分类id');
            $table->integer('user_id')->unsigned()->comment('作者id');
            $table->integer('comment_count')->default(0)->index()->comment('评论数量');
            $table->integer('view_count')->unsigned()->default(0)->index()->comment('查看数量');
            $table->integer('vote_count')->default(0)->index()->comment('点赞数量');
            $table->integer('last_comment_user_id')->unsigned()->default(0)->index()->comment('最近一次评论者');
            $table->integer('weight')->default(50)->index()->comment('权重');
            $table->enum('is_excellent', ['yes', 'no'])->default('no')->index()->comment('是否是优秀文章');
            $table->enum('is_hot', ['yes', 'no'])->default('no')->index()->comment('是否是热门文章');
            $table->enum('only_owner_can_see', ['yes', 'no'])->default('no')->index()->comment('是否仅自己可见');
            $table->enum('is_draft', ['yes', 'no'])->default('no')->index()->comment('是否为草稿');
            $table->string('title')->index()->comment('标题');
            $table->string('slug')->unique()->comment('缩略标题');
            $table->text('content')->comment('文章内容');
            $table->string('description')->nullable()->comment('描述');
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
        Schema::dropIfExists('articles');
    }
}
