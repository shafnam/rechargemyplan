<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carrier_id')->unsigned();
            $table->string('name');
            $table->string('logo');
            $table->mediumText('description');
            $table->decimal('price', 10, 2);
            $table->tinyInteger('discount_check');
            $table->tinyInteger('goto_special_segment');
            $table->tinyInteger('status');
            $table->decimal('discount_percentage', 10, 2);
            $table->decimal('sim_discount_percentage', 10, 2);
            $table->string('sim_logo');            
            $table->timestamps();
        });

        Schema::table('plans', function($table) {
            $table->foreign('carrier_id')->references('id')->on('carriers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
