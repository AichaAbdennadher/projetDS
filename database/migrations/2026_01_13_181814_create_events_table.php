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
        Schema::create('aa_events', function (Blueprint $table) {
            $table->id('aa_id');
            $table->string('aa_title');
            $table->text('aa_description');
            $table->dateTime('aa_start_date');
            $table->dateTime('aa_end_date');
            $table->string('aa_place');
            $table->decimal('aa_price', 8, 2)->default(0);
            $table->integer('aa_capacity');
            $table->string('aa_image')->nullable();
            $table->boolean('aa_is_free')->default(false);
            
            // Foreign keys
            $table->foreignId('aa_category_id')->constrained('aa_categories', 'aa_id')->onDelete('cascade');
            $table->foreignId('aa_created_by')->constrained('aa_users', 'aa_id')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aa_events');
    }
};
