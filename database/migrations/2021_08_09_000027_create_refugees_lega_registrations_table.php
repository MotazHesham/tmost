<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefugeesLegaRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('refugees_lega_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('company');
            $table->string('position');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
