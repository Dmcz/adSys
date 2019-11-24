<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('question_id')->default(0)->comment('问卷id');
            $table->string('contact_name', 64)->default('')->comment('联系人姓名');
            $table->string('contact_mobile', 32)->default('')->comment('联系人电话');
            $table->json('content')->nullable(true)->comment('内容');
            $table->timestamps();

            $table->index('user_id');
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
        Schema::dropIfExists('question_results');
    }
}
