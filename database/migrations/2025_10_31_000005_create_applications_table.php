<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('applicant_id')->constrained('users')->onDelete('cascade');
            $table->string('resume_url');
            $table->text('cover_letter')->nullable();
            $table->string('status')->default('applied'); // applied, reviewed, shortlisted, rejected, hired
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
