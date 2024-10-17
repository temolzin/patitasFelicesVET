<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\VetAppointment;

class CreateVetAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vet_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('animal_id');
            $table->datetime('schedule_date');
            $table->string('reason');
            $table->enum('status', VetAppointment::APPOINTMENT_STATUS);
            $table->text('observation')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('animal_id');

            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vet_appointments');
    }
}
