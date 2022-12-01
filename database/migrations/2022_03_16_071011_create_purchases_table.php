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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('good_id');
            $table->foreign('good_id')->references('id')->on('goods');
            $table->tinyInteger('quantity');
            $table->integer('price_per');
            $table->integer('total');
            $table->date('date');
            $table->unsignedBigInteger('proc_id');
            $table->foreign('proc_id')->references('id')->on('procurements');
            $table->string('status',5);
            $table->text('description');
            $table->integer('sokok');
            $table->integer('tax');
            $table->integer('taminat');
            $table->integer('kasrat');
            $table->integer('payment');
            $table->string('prepared',30);
            $table->date('manzori');
            $table->string('amer',30);
            $table->string('boss',30);
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
        Schema::dropIfExists('purchases');
    }
};
