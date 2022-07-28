<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_koli', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_key');
            $table->string('koli_key');
            $table->foreign('user_key')->constrained()->references('email')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('koli_key')->constrained()->references('koli')->on('koli')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_koli');
    }
};
