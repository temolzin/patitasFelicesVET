<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('vet_member_id');
            $table->date('adoption_date');
            $table->text('observation');
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->foreign('vet_member_id')->references('id')->on('vet_member')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adoptions');
    }
}
