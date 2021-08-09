<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToConsultingBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('consulting_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('consulting_id');
            $table->foreign('consulting_id', 'consulting_fk_4572277')->references('id')->on('consultings');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4572278')->references('id')->on('users');
        });
    }
}
