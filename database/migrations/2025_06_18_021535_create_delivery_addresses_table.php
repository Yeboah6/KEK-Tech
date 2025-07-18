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
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users');
            $table -> string('country');
            $table -> string('first_name');
            $table -> string('last_name');
            $table -> string('company_name') -> nullable();
            $table -> string('address_1');
            $table -> string('address_2') -> nullable();
            $table -> string('city');
            $table -> string('state');
            $table -> string('zip_code');
            $table -> string('email');
            $table -> string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_addresses');
    }
};
