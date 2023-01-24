<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->UnsignedBigInteger('user_id');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone');
            $table->string('transaction_id');
            $table->string('order_id')->nullable();
            $table->string('gross_amount')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('pdf_url')->nullable();
            $table->string('confirmation')->default('not confirmed');
            $table->string('total_ongkir')->nullable();
            $table->string('jasa_pengiriman')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('user_name')->references('name')->on('users');
            // $table->foreign('user_email')->references('email')->on('users');
            // $table->foreign('user_phone')->references('phone')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
