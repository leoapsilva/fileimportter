<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 255)->nullable();
            $table->string('email')->nullable();
            $table->string('gender', 25)->nullable();
            $table->string('ip_address', 25)->nullable();
            $table->string('company', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('title', 50)->nullable();
            $table->longText('website')->nullable();
            $table->timestamps();
            $table->unique(['first_name', 'last_name', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
