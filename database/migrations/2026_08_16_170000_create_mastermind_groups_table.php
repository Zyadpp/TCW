<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mastermind_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('instructor_name');
            $table->unsignedInteger('members_count');
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mastermind_groups');
    }
};
