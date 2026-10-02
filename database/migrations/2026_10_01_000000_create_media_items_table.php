<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->string('video_path');
            $table->string('original_name');
            $table->string('visibility', 20)->default('Friends');
            $table->string('status', 20)->default('Pending');
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('media_items'); }
};
