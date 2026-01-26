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
            // Drop the existing foreign key with cascade
            // Laravel usually names it table_column_foreign, so aa_events_aa_category_id_foreign
            $table->dropForeign(['aa_category_id']);
            
            // Re-add foreign key without cascade (defaults to restrict behavior)
            $table->foreign('aa_category_id')
                  ->references('aa_id')
                  ->on('aa_categories'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aa_events', function (Blueprint $table) {
             $table->dropForeign(['aa_category_id']);
             
             // Restore cascade
             $table->foreign('aa_category_id')
                  ->references('aa_id')
                  ->on('aa_categories')
                  ->onDelete('cascade');
        });
    }
};
