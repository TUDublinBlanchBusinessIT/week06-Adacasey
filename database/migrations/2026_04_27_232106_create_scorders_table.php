<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScordersTable extends Migration
{
    public function up()
    {
        Schema::create('scorders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('orderdate');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scorders');
    }
}