<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPackagesOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('packages_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4572256')->references('id')->on('users');
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id', 'package_fk_4572257')->references('id')->on('packages');
        });
    }
}
