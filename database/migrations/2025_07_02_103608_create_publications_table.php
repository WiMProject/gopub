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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('abstract');
            $table->text('content');
            $table->string('authors');
            $table->string('keywords')->nullable();
            $table->string('publication_type'); // jurnal, karya ilmiah, dll
            $table->string('file_path')->nullable();
            $table->integer('views')->default(0);
            $table->integer('downloads')->default(0);
            $table->string('status')->default('draft'); // draft, published, rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
