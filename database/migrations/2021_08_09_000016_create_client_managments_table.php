<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientManagmentsTable extends Migration
{
    public function up()
    {
        Schema::create('client_managments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('comany');
            $table->string('position');
            $table->string('service');
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
