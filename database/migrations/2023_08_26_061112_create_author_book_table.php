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
        Schema::create('author_book', function (Blueprint $table) {
            $table->id(); // This adds an auto-incrementing primary key column named 'id'
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('book_id');
            $table->timestamps(); // This adds 'created_at' and 'updated_at' columns

            // Foreign key constraints
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');

            // Unique constraint to ensure an author can't be associated with the same book more than once
            $table->unique(['author_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_book');
    }
};
