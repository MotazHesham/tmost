<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSeminarsSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('seminars_subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('seminar_id');
            $table->foreign('seminar_id', 'seminar_fk_4572303')->references('id')->on('seminars');
        });
    }
}
