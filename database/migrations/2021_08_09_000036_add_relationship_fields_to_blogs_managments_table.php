<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBlogsManagmentsTable extends Migration
{
    public function up()
    {
        Schema::table('blogs_managments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4570347')->references('id')->on('users');
        });
    }
}
