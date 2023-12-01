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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('invoice_no')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('first_name');
            $table->string('lastname');
            $table->string('email');
            $table->unsignedBigInteger('telephone');
            $table->string('payment_firstname');
            $table->string('payment_lastname');
            $table->string('payment_company');
            $table->string('payment_address_1');
            $table->string('payment_address_2');
            $table->string('payment_city');
            $table->string('payment_postcode');
            $table->string('shipping_firstname');
            $table->string('shipping_lastname');
            $table->string('shipping_company');
            $table->string('shipping_address_1');
            $table->string('shipping_address_2');
            $table->string('shipping_city');
            $table->string('shipping_postcode');
            $table->double('total', 8, 2);
            $table->tinyInteger('status')->default(1);
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
