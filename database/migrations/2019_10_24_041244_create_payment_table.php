<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userId');
            $table->string('msg', 191);
            $table->string('amount', 191);
            $table->string('payment_request_id', 191)->nullable();
            $table->string('payment_id', 191)->nullable();
            $table->integer('status')->default(1)->comment('1 = Un-Paid, 2 = Paid, 3 = Payment Done, 4 = Payment Failed');
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
        Schema::dropIfExists('payment');
    }
}
