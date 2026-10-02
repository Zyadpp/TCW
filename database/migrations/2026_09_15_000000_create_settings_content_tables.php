<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('overview')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('status', 20)->default('Published');
            $table->boolean('is_pinned')->default(false);
            $table->date('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('point_actions', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20);
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('points');
            $table->string('limitations', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('type', 50);
            $table->string('attachment')->nullable();
            $table->string('status', 20)->default('Pending');
            $table->timestamps();
        });

        Schema::create('content_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->text('body');
            $table->timestamps();
        });

        Schema::create('chatbot_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('chatbot_files', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('original_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chatbot_files');
        Schema::dropIfExists('chatbot_questions');
        Schema::dropIfExists('content_comments');
        Schema::dropIfExists('support_tickets');
        Schema::dropIfExists('point_actions');
        Schema::dropIfExists('blogs');
    }
};
