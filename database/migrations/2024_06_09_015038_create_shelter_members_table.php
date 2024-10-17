<?php

use App\Models\ShelterMember;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheltermembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelter_member', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('last_name');
                $table->string('phone');
                $table->string('email');
                $table->string('state');
                $table->string('city');
                $table->string('colony');
                $table->string('address');
                $table->string('postal_code');
                $table->enum('type_member', ShelterMember::TYPE_MEMBER)->nullable();
                $table->unsignedBigInteger('shelter_id');
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('shelter_id')->references('id')->on('shelters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shelter_member');
    }
}
