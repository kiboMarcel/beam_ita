<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_students', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->change();

            
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')
                ->references('id')->on('student_classes')
                ->onDelete('cascade');

            $table->integer('branch_id')->nullable();

            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')
                ->references('id')->on('student_groups')
                ->onDelete('cascade');

            $table->unsignedBigInteger('year_id');
            $table->foreign('year_id')
                ->references('id')->on('student_years')
                ->onDelete('cascade');

                $table->string('status');

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
        Schema::dropIfExists('assign_students');
    }
}
