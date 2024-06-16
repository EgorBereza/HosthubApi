<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_rental');
            $table->unsignedBigInteger('rental');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->foreign('parent_rental')->references('id')->on('rentals')->onDelete('cascade');
            $table->foreign('rental')->references('id')->on('rentals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
