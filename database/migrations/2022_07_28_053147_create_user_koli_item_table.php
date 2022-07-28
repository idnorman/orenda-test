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
        Schema::create('user_koli_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_koli_id')->constrained()->references('id')->on('user_koli')->onUpdate('cascade')->onDelete('cascade');
            $table->string('item_key');
            $table->foreign('item_key')->constrained()->references('name')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_koli_item');
    }
};
