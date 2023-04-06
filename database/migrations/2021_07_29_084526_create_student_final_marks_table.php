<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFinalMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_final_marks', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('id_no')->nullable();

            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')
                ->references('id')->on('student_years')
                ->onDelete('cascade');

            $table->integer('class_id')->nullable();

            $table->integer('branch_id')->nullable();

            $table->integer('group_id')->nullable();

            $table->unsignedBigInteger('assign_subject_id');
            $table->foreign('assign_subject_id')
                ->references('id')->on('assign_subjects')
                ->onDelete('cascade');

            $table->integer('season_id')->nullable();

            $table->double('final_marks')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_final_marks');
    }
}
