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
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("booking_id")->constrained()->onDelete("cascade");
            $table->string("type");
            $table->string("firstname");
            $table->string("lastname");
            $table->string("nationality");
            $table->string("dob_year");
            $table->string("dob_month");
            $table->string("dob_day");
            $table->string("passport");
            $table->string("passport_year");
            $table->string("passport_month");
            $table->string("passport_day");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
