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
            $table->text('overview');
            $table->string('website');
            $table->string('brand_color')->default('#fefefe');
            $table->string('logo')->default('myimage.png');
            $table->integer('company_size')->default(1);
            $table->integer('founded')->default(2000);
            $table->string('headerquarters')->default('Canada');
            $table->boolean('active')->default(true);
            // Relationship
            $table->foreignId('business_category_id')
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
