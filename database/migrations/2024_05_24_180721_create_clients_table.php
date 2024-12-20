<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->unsignedBigInteger('animal_id');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('state'); 
            $table->string('city');  
            $table->string('colony');  
            $table->string('address');  
            $table->string('postal_code');
            $table->integer('number_pets')->default(0);  
            $table->text('observations')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
