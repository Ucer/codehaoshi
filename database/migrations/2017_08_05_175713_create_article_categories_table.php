<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('parent_id')->unsigned()->default(0)->comment('父id');
            $table->string('name')->index()->comment('名称');
            $table->string('slug', 60)->unique()->comment('缩略名');
            $table->tinyInteger('weight')->default(0)->comment('权重');
            $table->integer('article_count')->default(0)->comment('文章数');
            $table->string('description')->nullable();
            $table->string('image_url')->nullable()->comment('封面图片');
            $table->string('style', 30)->default('violet')->comment('样式');
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
        Schema::dropIfExists('article_categories');
    }
}
