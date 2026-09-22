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
        Schema::create('scrape_job_runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scrape_company_job_id')->constrained()->cascadeOnDelete();
            $table->timestamp('started_at');
            $table->timestamp('finished_at')->nullable();
            $table->enum('status', ['running', 'success', 'failed', 'partial'])->default('running');
            $table->integer('jobs_found')->default(0);
            $table->integer('jobs_new')->default(0);
            $table->integer('jobs_updated')->default(0);
            $table->integer('errors_count')->default(0);
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scrape_job_runs');
    }
};
