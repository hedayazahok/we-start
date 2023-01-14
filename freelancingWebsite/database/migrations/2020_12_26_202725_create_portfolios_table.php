<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('desc');
        $table->longText('urls')->nullable();;
        $table->date('exec_date');
        $table->json('skills')->nullable();
        $table->foreignId('freelancer_id');
        $table->foreignId('category_id');
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
        Schema::dropIfExists('portfolios');
    }
}
