<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBoottomInfoToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->string('form_title')->nullable()->default('')->comment('表单标题')->after('description');
            $table->string('bottom_title')->nullable()->default('')->comment('底部标题')->after('form_title');
            $table->string('bottom_info')->nullable()->default('')->comment('底部描述')->after('bottom_title');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('form_title');
            $table->dropColumn('bottom_title');
            $table->dropColumn('bottom_info');
        });
    }
}
