<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('template_id');

            $table->date('manufacture_date');
            $table->date('expiry_date');
            $table->string('batch_number', 16);
            $table->integer('quantity');
            $table->string('file', 64);
            $table->string('destination', 128)->nullable();
            $table->enum('status', ['running', 'pending', 'finished'])->default('running');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
