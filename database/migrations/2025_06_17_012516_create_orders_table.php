<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table -> integer('order_id');
            $table -> bigInteger('customer_id')->unsigned()->index()->nullable();
            $table -> foreign('customer_id') -> references('id') -> on('customers') ->onDelete('cascade');

            $table -> string('cart_id') -> nullable();
            $table -> string('address_id') -> nullable();
            $table -> integer('total') -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
