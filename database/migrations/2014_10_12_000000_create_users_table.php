<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('usertype')->nullable()->comment('Students, Employee, Admin');
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('nationality')->nullable();
            $table->string('id_no')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('code')->nullable();
            $table->string('role')->nullable()->comment('admin= maitre du logiciel, operateur=
            computer operator, user=employee');
            $table->date('join_date')->nullable();
            $table->string('contrat')->nullable();
            $table->integer('designation_id')->nullable();
            $table->double('salary')->nullable();
            $table->tinyInteger('status')->default(1)->commment('0=inactive, 1=active');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
}
