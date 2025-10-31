<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->decimal('salary_min', 10, 2);
            $table->decimal('salary_max', 10, 2);
            $table->string('type'); // full-time, part-time, contract
            $table->string('status')->default('pending'); // pending, approved, closed
            $table->timestamp('posted_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
