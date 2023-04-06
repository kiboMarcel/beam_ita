<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->unique();
            $table->timestamps();
        });

        DB::table('exam_types')->insert(
            array(
                [ 'name' => 'Intero', 'description' => 'Intero'],
               [ 'name' => 'Devoir', 'description' => 'Devoir'],
               [ 'name' => 'Compo', 'description' => 'Examen'],
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_types');
    }
}
