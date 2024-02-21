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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });


        Schema::create('article_category', function (Blueprint $table) {
            $table->foreignId('article_id')->references('id')->on('articles')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->primary(['article_id','category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
