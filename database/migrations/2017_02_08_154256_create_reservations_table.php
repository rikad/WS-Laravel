<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('renovations');
        Schema::dropIfExists('room_item');
        Schema::dropIfExists('reservation_item');
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('items');
        Schema::dropIfExists('class');

        Schema::create('class', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',10)->unique();
            $table->string('description',100)->nullable();
            $table->integer('price');
        });

        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',20)->unique();
            $table->string('name',20);
            $table->string('description',100)->nullable();
            $table->integer('price')->nullable();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',10)->unique();
            $table->string('description',100)->nullable();
            $table->integer('class_id')->unsigned();

            $table->foreign('class_id')->references('id')->on('class')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('renovations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description',100);
            $table->integer('room_id')->unsigned();

            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->datetime('checkin');
            $table->datetime('checkout');
            $table->integer('status');
            $table->json('detail')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('reservation_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->integer('reservation_id')->unsigned();
            $table->integer('price')->nullable();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renovations');
        Schema::dropIfExists('room_item');
        Schema::dropIfExists('reservation_item');
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('items');
        Schema::dropIfExists('class');
        Schema::dropIfExists('guests');
    }
}
