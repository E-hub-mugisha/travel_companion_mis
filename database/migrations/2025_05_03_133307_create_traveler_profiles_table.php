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
        Schema::create('traveler_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('bio')->nullable();
            $table->string('interests')->nullable(); // comma-separated tags
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade'); // Assuming you have a destinations table
            $table->string('travel_preferences')->nullable(); // comma-separated tags
            $table->string('travel_budget')->nullable(); // e.g., 'low', 'medium', 'high'
            $table->string('travel_duration')->nullable(); // e.g., '1 week', '2 weeks'
            $table->string('travel_companions')->nullable(); // e.g., 'solo', 'couple', 'family'
            $table->string('travel_experience')->nullable(); // e.g., 'beginner', 'intermediate', 'expert'
            $table->enum('travel_style', ['budget', 'adventure', 'luxury'])->default('budget');
            $table->string('travel_photos')->nullable(); // URL or path to travel photos
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('price')->nullable(); // e.g., '1000', '2000'
            $table->boolean('is_active')->default(true); // To manage profile visibility
            $table->boolean('is_verified')->default(false); // To manage profile verification
            $table->boolean('is_featured')->default(false); // To manage profile visibility
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traveler_profiles');
    }
};
