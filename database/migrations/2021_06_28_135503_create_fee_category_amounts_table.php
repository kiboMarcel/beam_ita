<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeCategoryAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_category_amounts', function (Blueprint $table) {
            $table->id();
            //$table->bigInteger('fee_category_id');

            $table->unsignedBigInteger('fee_category_id');
            $table->foreign('fee_category_id')
                ->references('id')->on('fee_categories')
                ->onDelete('cascade');

            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')
                ->references('id')->on('student_classes')
                ->onDelete('cascade')
                ->change();

            $table->double('amount');
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
        Schema::dropIfExists('fee_category_amounts');
    }
}
