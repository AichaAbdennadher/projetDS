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
        Schema::table('aa_events', function (Blueprint $table) {
            if (Schema::hasColumn('aa_events', 'aa_available_seats')) {
                $table->dropColumn('aa_available_seats');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aa_events', function (Blueprint $table) {
            $table->integer('aa_available_seats')->nullable();
        });
    }
};
