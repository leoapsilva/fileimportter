<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('address_1', 50);
            $table->string('address_2', 50)->nullable();
            $table->string('number', 10)->nullable();
            $table->string('city', 100);
            $table->string('state', 50)->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->string('reference', 255)->nullable();
            $table->string('country', 128);
            $table->unsignedBigInteger('ship_order_id');
            $table->foreign('ship_order_id')->references('id')->on('ship_orders');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['ship_order_id', 'name', 'address_1', 'city', 'country']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
