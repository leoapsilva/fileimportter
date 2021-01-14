<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('note', 512);
            $table->integer('quantity');
            $table->float('price', 16, 2);
            $table->unsignedBigInteger('ship_order_id');
            $table->foreign('ship_order_id')->references('id')->on('ship_orders');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['ship_order_id', 'title', 'quantity', 'price']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
