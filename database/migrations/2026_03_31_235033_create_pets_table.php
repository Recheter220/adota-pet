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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table->string('name', 100);
            $table->enum('species', ['dog', 'cat'])->default('dog');
            $table->enum('gender', ['m', 'f', 'u'])->default('u');
            $table->string('breed', 50)->nullable();
            $table->string('color', 50)->nullable();
            $table->date('birthday')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
