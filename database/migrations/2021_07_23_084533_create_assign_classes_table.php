<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_classes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')
                ->references('id')->on('student_classes')
                ->onDelete('cascade')
                ->change();
            
            $table->integer('branch_id')->nullable();
           

            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')
                ->references('id')->on('student_groups')
                ->onDelete('cascade')
                ->change();

                
            $table->integer('pass_mark')->nullable();
            
            $table->integer('teacher_id');


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
        Schema::dropIfExists('assign_classes');
    }
}
