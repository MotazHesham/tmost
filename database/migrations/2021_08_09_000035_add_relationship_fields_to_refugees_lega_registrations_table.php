<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRefugeesLegaRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('refugees_lega_registrations', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id', 'service_fk_4572171')->references('id')->on('refugees_legal_services');
        });
    }
}
