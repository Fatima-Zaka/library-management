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
        Schema::create('borrowed_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patron_id');
            $table->unsignedBigInteger('book_id');
            $table->date('borrowed_on')->default(now());
            $table->date('due_on')->default(now()->addDays(14)); // Assuming a 2-week borrowing period
            $table->timestamps();

            $table->foreign('patron_id')->references('id')->on('patrons')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowed_books');
    }
};
