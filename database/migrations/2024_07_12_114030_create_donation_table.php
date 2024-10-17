<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Donation;

class CreateDonationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shelter_member_id');
            $table->datetime('donation_date');
            $table->enum('type', Donation::DONATION)->nullable();
            $table->string('amount');
            $table->text('observation');
            $table->timestamps();
            $table->softDeletes();
           
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
        Schema::dropIfExists('donations');
    }
}
