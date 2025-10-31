<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('thread_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('comment_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('type'); // like, love, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
