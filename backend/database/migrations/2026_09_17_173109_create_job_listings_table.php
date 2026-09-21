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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('slug')->unique();
            $table->longText('description');
            $table->text('address')->nullable();
            $table->text('location')->nullable();
            $table->char('country', 2)->default('CA');
            $table->decimal('salary', 10, 2)->nullable();
            $table->boolean('published')->boolean(false);
            // Offical application url
            $table->text('apply_url');
            $table->date('posted_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('system_posted_date')
                ->useCurrent();
            $table->timestamps();
            // Foreign tables
            $table->foreignId('company_id')
                ->nullable()
                ->constrained('companies')
                ->nullOnDelete();

            // $table->foreignId('employment_type_id')
            //     ->nullable()
            //     ->constrained('employment_types')
            //     ->nullOnDelete();

            // $table->foreignId('job_role_id')
            //     ->nullable()
            //     ->constrained('job_roles')
            //     ->nullOnDelete();

            // $table->foreignId('city_id')
            //     ->nullable()
            //     ->constrained('cities')
            //     ->nullOnDelete();

            $table->foreignId('province_id')
                ->nullable()
                ->constrained('provinces')
                ->nullOnDelete();

            // Index these columns for the optimize and faster query
            $table->index('company_id');
            // $table->index('city_id');
            $table->index('province_id');
            // $table->index('employment_type_id');
            // $table->index('job_role_id');
            $table->index('published');
            $table->index('posted_date');
            $table->index('due_date');
            $table->index(['published', 'posted_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
