<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnualAVGSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_a_v_g_s', function (Blueprint $table) {
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
            $table->double('annual_avg')->nullable();
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
        Schema::dropIfExists('annual_a_v_g_s');
    }
}
