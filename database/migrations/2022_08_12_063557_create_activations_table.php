<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('otp');
            $table->boolean('completed')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activations');
    }
};
