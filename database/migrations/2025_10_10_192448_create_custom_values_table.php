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
        Schema::create('custom_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->constrained('custom_fields')->onDelete('cascade');
            $table->unsignedBigInteger('entity_id'); // Puede ser user, course o group
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_values');
    }
};
