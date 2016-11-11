<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id'); // Assignment
            $table->integer('project_id');
            $table->integer('category_id');
            $table->integer('priority_id');
            $table->integer('milestone_id');
            $table->integer('created_by');
            $table->string('title');
            $table->text('description');
            $table->integer('estimate');
            $table->integer('time_spent');
            $table->boolean('closed')->default(false);
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
        Schema::drop('issues');
    }
}
