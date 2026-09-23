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

            // What / how to fetch
            $table->string('base_url');
            $table->enum('method', ['GET', 'POST'])->default('POST');
            $table->enum('response_type', ['json', 'html'])->default('json');
            $table->json('request_body')->nullable();            // POST payload template
            // Headers
            $table->string('origin')->nullable();
            $table->string('referer')->nullable();
            $table->enum('accept', [
                'application/json',
                'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            ])->default('application/json');
            $table->string('accept_language')->default('en-CA,en;q=0.9');
            $table->string('accept_encoding')->default('gzip, deflate, br');
            $table->string('content_type')->nullable();           // null for GET
            $table->string('user_agent')->nullable();
            $table->json('extra_headers')->nullable();            // Sec-Fetch-*, custom tokens, etc.

            // JSON extraction
            $table->string('json_data_path')->nullable();
            // HTML extraction
            $table->string('list_selector')->nullable();
            $table->json('selectors')->nullable();

            // Session / pacing
            $table->string('cookie_jar_path')->nullable();
            $table->unsignedInteger('rate_limit_seconds')->default(3); // between requests within one run
            $table->unsignedInteger('timeout_seconds')->default(15);
            $table->unsignedInteger('max_retries')->default(2);

            // Scheduling / state
            $table->integer('scrape_frequency_minutes')->default(1440); // how often to re-run entirely
            $table->timestamp('last_scraped_at')->nullable();
            $table->string('last_status')->nullable();
            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->unique(['company_id', 'scrape_platform_id']);
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
