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
        Schema::create('aa_registrations', function (Blueprint $table) {
            $table->id('aa_id');
            $table->foreignId('aa_user_id')->constrained('aa_users', 'aa_id')->onDelete('cascade');
            $table->foreignId('aa_event_id')->constrained('aa_events', 'aa_id')->onDelete('cascade');
            // Un utilisateur ne peut s'inscrire qu'une seule fois par événement
            $table->unique(['aa_user_id', 'aa_event_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aa_registrations');
    }
};
