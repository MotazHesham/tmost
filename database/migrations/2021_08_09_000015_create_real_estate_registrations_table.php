<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstateRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('real_estate_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('type');
            $table->string('code');
            $table->longText('comment');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
