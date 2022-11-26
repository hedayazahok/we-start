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
        Schema::create('booking_operations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->double('price');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->foreignId('chalet_id')
            ->nullable()
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('num_adult')->default(1);
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
        Schema::dropIfExists('booking_operations');
    }
};
