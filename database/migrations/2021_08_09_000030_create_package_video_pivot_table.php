<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageVideoPivotTable extends Migration
{
    public function up()
    {
        Schema::create('package_video', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id', 'package_id_fk_4569909')->references('id')->on('packages')->onDelete('cascade');
            $table->unsignedBigInteger('video_id');
            $table->foreign('video_id', 'video_id_fk_4569909')->references('id')->on('videos')->onDelete('cascade');
        });
    }
}
