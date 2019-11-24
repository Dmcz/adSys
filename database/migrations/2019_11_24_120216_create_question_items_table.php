<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->comment('所属问题id');
            $table->tinyInteger('status')->default(0)->comment('状态');
            $table->string('title', 128)->default('')->comment('问题名称');
            $table->text('value')->nullable(true)->default(0)->comment('可能答案');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('question_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_items');
    }
}
