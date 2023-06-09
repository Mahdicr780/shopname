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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->char('payment_id',32)->index();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('basket_id')->nullable();
            $table->foreign('basket_id')->references('id')->on('baskets')->onDelete('cascade');
            $table->unsignedInteger('paid');
            $table->unsignedInteger('status')->default(1);
            $table->text('invoice_details')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('transaction_result')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
?>
