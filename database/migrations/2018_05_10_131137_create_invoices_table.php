<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->double('total', 2);
            $table->string('payment_status')->nullable();
            $table->string('recurring_id')->nullable();
            $table->integer('user_id');
            $table->decimal('handling_fee', 10, 2);
            $table->integer('items_count')->nullable();
            $table->string('paypal_email')->nullable(); 
            $table->string('transaction_id')->nullable();
            $table->string('order_status')->nullable(); 
            $table->tinyInteger('active')->nullable();
            $table->tinyInteger('web_mobile')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
