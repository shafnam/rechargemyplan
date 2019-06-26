<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carriers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('logo');
            $table->mediumText('description');
            $table->tinyInteger('status');
            $table->string('plan_name_color');
            $table->string('plan_value_color');
            $table->string('plan_description_color');
            $table->string('plan_value_text_color');
            $table->tinyInteger('plan_status');
            $table->tinyInteger('sim_status');
            $table->string('sim_image');
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
        Schema::dropIfExists('carriers');
    }
}
