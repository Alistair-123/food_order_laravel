<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('food_item_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('food_item_id')->references('id')->on('food_items');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}