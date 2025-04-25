<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('workshops', function (Blueprint $table) {
            if (!Schema::hasColumn('workshops', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
            if (!Schema::hasColumn('workshops', 'instructor')) {
                $table->string('instructor')->nullable()->after('description');
            }
            if (!Schema::hasColumn('workshops', 'level')) {
                $table->string('level')->default('Beginner')->after('instructor');
            }
            if (!Schema::hasColumn('workshops', 'topics')) {
                $table->json('topics')->nullable()->after('level');
            }
            if (!Schema::hasColumn('workshops', 'duration')) {
                $table->string('duration')->nullable()->after('topics');
            }
            if (!Schema::hasColumn('workshops', 'capacity')) {
                $table->integer('capacity')->default(30)->after('duration');
            }
            if (!Schema::hasColumn('workshops', 'start_time')) {
                $table->time('start_time')->nullable()->after('date');
            }
            if (!Schema::hasColumn('workshops', 'end_time')) {
                $table->time('end_time')->nullable()->after('start_time');
            }
        });
    }

    public function down(): void
    {
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'instructor',
                'level',
                'topics',
                'duration',
                'capacity',
                'start_time',
                'end_time'
            ]);
        });
    }
};
