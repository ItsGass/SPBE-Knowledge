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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 120)->unique();
            $table->string('password_hash', 255); // Mengganti 'password' standar Laravel
            $table->enum('role', ['superadmin', 'admin', 'editor'])->default('admin');
            $table->rememberToken()->nullable(); // Kolom standar untuk fitur "remember me"
            $table->timestamps(); // Termasuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};