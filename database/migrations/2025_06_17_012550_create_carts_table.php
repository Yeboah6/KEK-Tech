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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            $table -> bigInteger('customer_id')->unsigned()->index()->nullable();
            $table -> foreign('customer_id') -> references('id') -> on('customers') ->onDelete('cascade');

            $table -> string('product_id'); // Link address_id to Delivery Address
            $table -> string('cart_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
