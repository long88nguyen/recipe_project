<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id()->from(1000);
            $table->unsignedBigInteger('user_id');
            $table->string('name',30);
            $table->integer('phone')->default(123456789);
            $table->integer('gender')->nullable();
            $table->date('birthday')->default('2000-01-01');
            $table->string('avatar')->default('images/avatars/avatar.png');
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
        Schema::dropIfExists('members');
    }
}
