<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_marks', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('id_no')->nullable();

            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')
                ->references('id')->on('student_years')
                ->onDelete('cascade');

            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')
                ->references('id')->on('student_classes')
                ->onDelete('cascade');
                
            $table->integer('branch_id')->nullable();

            $table->integer('group_id')->nullable();

            $table->unsignedBigInteger('assign_subject_id');
            $table->foreign('assign_subject_id')
                ->references('id')->on('assign_subjects')
                ->onDelete('cascade');

           

            $table->unsignedBigInteger('exam_type_id');
            $table->foreign('exam_type_id')
                ->references('id')->on('exam_types')
                ->onDelete('cascade');

            $table->integer('season_id')->nullable();
            $table->double('marks')->nullable(); 
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
        Schema::dropIfExists('student_marks');
    }
}
