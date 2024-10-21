<?php

use App\Models\VetMember;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVetmembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vet_member', function (Blueprint $table) {
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
                $table->enum('type_member', VetMember::TYPE_MEMBER)->nullable();
                $table->unsignedBigInteger('vet_id');
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('vet_id')->references('id')->on('vets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vet_member');
    }
}
