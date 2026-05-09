<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_block_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('badge')->nullable();
            $table->unsignedInteger('order_index')->default(0)->index();
            $table->json('extra')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_items');
    }
};
