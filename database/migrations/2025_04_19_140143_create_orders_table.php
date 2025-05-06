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
            $table->integer('total');
            $table->string("first_name");
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('postal_code');
            $table->timestamps();


            $table->foreignId('delivery_method_id')->constrained();
            $table->foreignId('payment_method_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            // Used to allow access to order submitted view for guest users
            $table->string('session_id');
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
