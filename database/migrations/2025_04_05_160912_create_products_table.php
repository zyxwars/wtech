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
//        Column types
//        https://laravel.com/docs/12.x/migrations#available-column-types

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('release_year');
            $table->integer('price');
            $table->timestamps();

//            Foreign key constraints
//            https://laravel.com/docs/12.x/migrations#foreign-key-constraints
            $table->foreignId('author_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('language_id')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
