<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')
                ->references('id')->on('student_classes')
                ->onDelete('cascade');

            $table->integer('branch_id')->nullable();
            
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')
                ->references('id')->on('school_subjects')
                ->onDelete('cascade');
            
            $table->integer('teacher_id');

            $table->double('full_mark');
            $table->double('pass_mark')->nullable();
            $table->integer('coef');
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
        Schema::dropIfExists('assign_subjects');
    }
}
