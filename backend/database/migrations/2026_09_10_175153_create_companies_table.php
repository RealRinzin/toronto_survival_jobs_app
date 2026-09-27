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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug')->unique();
            $table->string('color_code')->default("#fff");
            $table->text('overview');
            $table->string('website');
            $table->string('brand_color');
            $table->string('logo')->default('myimage.png');
            $table->string('company_size');
            $table->integer('founded');
            $table->string('head_quarter');
            // Relationship
            $table->foreignId('business_category_id')
                ->nullable()
                ->constrained('business_categories')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
