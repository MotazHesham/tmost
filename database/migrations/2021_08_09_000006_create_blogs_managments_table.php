<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsManagmentsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs_managments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description');
            $table->string('status')->nullable();
            $table->longText('reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
