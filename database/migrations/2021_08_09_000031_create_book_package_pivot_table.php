<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookPackagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('book_package', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id', 'package_id_fk_4569908')->references('id')->on('packages')->onDelete('cascade');
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id', 'book_id_fk_4569908')->references('id')->on('books')->onDelete('cascade');
        });
    }
}
