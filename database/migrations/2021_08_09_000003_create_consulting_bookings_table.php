<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultingBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('consulting_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('meeting_link')->nullable();
            $table->datetime('meeting_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
