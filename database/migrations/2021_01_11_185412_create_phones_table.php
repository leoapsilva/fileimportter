<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->string('number', 20);
            $table->string('country', 5)->nullable();
            $table->string('area', 5)->nullable();
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')->references('id')->on('people');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['person_id', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
}
