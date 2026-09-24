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
        Schema::create('scraped_job_stagings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scrape_company_job_id')->constrained()->cascadeOnDelete();
            $table->foreignId('scrape_job_run_id')->constrained()->cascadeOnDelete();
            $table->string('external_id');
            $table->string('source_url');
            $table->json('raw_payload');
            $table->enum('status', ['pending', 'processed', 'failed', 'skipped'])->default('pending');
            $table->foreignId('job_listing_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamp('scraped_at');
            $table->timestamps();
            $table->unique(['scrape_job_run_id', 'external_id']); // dedup key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scraped_job_stagings');
    }
};
