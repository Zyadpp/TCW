<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::table('platform_settings', fn (Blueprint $table) => $table->json('notification_preferences')->nullable()); } public function down(): void { Schema::table('platform_settings', fn (Blueprint $table) => $table->dropColumn('notification_preferences')); } };
