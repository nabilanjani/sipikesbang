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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('staff_id')->constrained('staf')->onDelete('cascade'); // Referensi ke tabel staf
            $table->foreignId('bidang_id')->constrained('bidang')->onDelete('cascade'); // Referensi ke tabel bidang
            $table->integer('quantity');
            $table->string('email');
            $table->string('otp')->nullable();
            $table->date('submission_date');
            $table->string('description')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
