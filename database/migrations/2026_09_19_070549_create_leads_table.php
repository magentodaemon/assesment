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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
 
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('email_status')->nullable(); // e.g. valid, invalid, unknown, catch-all
 
            $table->string('company_name')->nullable();
            $table->string('position_title')->nullable();
            $table->string('position_location')->nullable();
            $table->string('industry_name')->nullable();
 
            $table->string('location')->nullable(); // person's general location
            $table->string('country_code', 4)->nullable();
 
            $table->string('persona')->nullable();
            $table->string('gender')->nullable();
 
            $table->timestamps();
 
            // Indexes to support the filterable query params on GET /leads
            $table->index('first_name');
            $table->index('last_name');
            $table->index('company_name');
            $table->index('position_title');
            $table->index('location');
            $table->index('email_status');
            $table->index('country_code');
            $table->index('industry_name');
            $table->index('position_location');
            $table->index('persona');
            $table->index('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
