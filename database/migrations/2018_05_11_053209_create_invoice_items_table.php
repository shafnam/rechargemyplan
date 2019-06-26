<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id');
            $table->integer('item_id');
            $table->string('item_name');
            $table->string('carrier_name');
            $table->decimal('item_price', 10, 2);
            $table->tinyInteger('item_discount_check');
            $table->decimal('item_discount_percentage', 10, 2);
            $table->string('item_type');
            $table->string('recharge_number');
            $table->string('item_logo');
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
        Schema::dropIfExists('invoice_items');
    }
}
