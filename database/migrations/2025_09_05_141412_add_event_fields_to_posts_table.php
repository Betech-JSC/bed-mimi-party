<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->date('date');
            $table->time('time');
            $table->string('location')->nullable()->after('time');
            $table->string('weekday')->nullable()->after('location');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['date', 'time', 'location', 'weekday']);
        });
    }
};
