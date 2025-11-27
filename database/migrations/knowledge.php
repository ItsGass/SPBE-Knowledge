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
        Schema::create('knowledge', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('author', 150)->nullable();
            $table->string('instansi', 150)->nullable();
            $table->text('description')->nullable();
            $table->date('publish_date')->nullable();
            $table->enum('format', ['dokumen', 'gambar', 'video', 'tautan', 'lainnya'])->default('dokumen');
            
            // Foreign Keys - Pastikan ini merujuk ke tabel yang sudah dibuat (scopes dan statuses)
            $table->foreignId('scope_id')->nullable()->constrained('scopes')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('status_id')->nullable()->constrained('statuses')->onUpdate('cascade')->onDelete('set null');
            
            $table->string('url', 255)->nullable();
            
            // FK ke tabel admins
            $table->foreignId('created_by')->nullable()->constrained('admins')->onUpdate('cascade')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knowledge');
    }
};