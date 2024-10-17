<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorship', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('shelter_member_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('amount');
            $table->string('observation');
            $table->timestamps();
            $table->softDeletes();
    
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->foreign('shelter_member_id')->references('id')->on('shelter_member')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsorship');
    }
}
