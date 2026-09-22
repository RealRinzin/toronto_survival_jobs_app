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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug')->unique();
            $table->text('overview');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->boolean('active')->default(false);
            $table->foreignId('province_id')
                ->nullable()
                ->constrained('provinces')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
