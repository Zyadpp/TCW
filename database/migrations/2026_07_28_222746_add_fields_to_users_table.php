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
    $columns = [
        'join_date' => fn (Blueprint $table) => $table->date('join_date')->nullable(),
        'course_title' => fn (Blueprint $table) => $table->string('course_title')->nullable(),
        'subscription_date' => fn (Blueprint $table) => $table->date('subscription_date')->nullable(),
        'plan' => fn (Blueprint $table) => $table->string('plan')->nullable(),
        'renewal_date' => fn (Blueprint $table) => $table->date('renewal_date')->nullable(),
    ];

    foreach ($columns as $name => $addColumn) {
        if (! Schema::hasColumn('users', $name)) {
            Schema::table('users', $addColumn);
        }
    }
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {

        $table->dropColumn([
            'join_date',
            'course_title',
            'subscription_date',
            'plan',
            'renewal_date'
        ]);

    });
}
};
