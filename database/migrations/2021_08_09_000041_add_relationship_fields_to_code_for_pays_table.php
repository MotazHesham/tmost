<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCodeForPaysTable extends Migration
{
    public function up()
    {
        Schema::table('code_for_pays', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4572311')->references('id')->on('users');
        });
    }
}
