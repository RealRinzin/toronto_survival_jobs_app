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
        Schema::create('scrape_company_jobs', function (Blueprint $table) {
$table->id();
    $table->foreignId('company_id')->constrained()->cascadeOnDelete();
    $table->foreignId('scrape_platform_id')->constrained()->cascadeOnDelete();
    $table->string('base_url');              // e.g. shopify.myworkdayjobs.com/...
    $table->string('user_agent')->nullable();
    $table->json('request_headers')->nullable();
    $table->integer('scrape_frequency_minutes')->default(1440);
    $table->timestamp('last_scraped_at')->nullable();
    $table->boolean('active')->default(true);
    $table->timestamps();

    $table->unique(['company_id', 'scrape_platform_id']); // one config per company+platform combo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scrape_company_jobs');
    }
};
