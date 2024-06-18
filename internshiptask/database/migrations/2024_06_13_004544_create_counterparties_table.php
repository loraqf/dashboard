<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('counterparties', function (Blueprint $table) {
            $table->id();
            $table->string('counterpartyname');
            $table->string('bulstat');
            $table->string('address', 250);
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('counterparties');
    }
};