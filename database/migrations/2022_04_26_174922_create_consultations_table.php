<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->enum('topic', ['Draudimo išmokos', 'Žalos atvėju', 'Draudimo produktai']);
            $table->enum('type', ['Telefonu', 'Vaizdo skambučiu']);
            $table->string('additional_info')->nullable();
            $table->dateTime('consultation_date');
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
        Schema::dropIfExists('consultations');
    }
}
