<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoolings', function (Blueprint $table) {
            $table->id();
            $table->double('payed');

            $table->integer('student_id');
            $table->integer('fee_category_id');
            $table->integer('year_id');
            
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')
                ->references('id')->on('student_classes')
                ->onDelete('cascade');

            $table->integer('branch_id')->nullable();

            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')
                ->references('id')->on('student_groups')
                ->onDelete('cascade');

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
        Schema::dropIfExists('schoolings');
    }
}
