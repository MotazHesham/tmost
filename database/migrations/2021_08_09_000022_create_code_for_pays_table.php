<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeForPaysTable extends Migration
{
    public function up()
    {
        Schema::create('code_for_pays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->longText('description');
            $table->decimal('price', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
