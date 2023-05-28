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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->string("pnr");
            $table->string("trip_type");
            $table->string("status")->default('Pending');
            $table->string("payment_method")->default('cash');
            $table->string("last_ticketing_date");
            $table->double("amount");
            $table->string("nego")->nullable();
            $table->string("received")->nullable();
            $table->string("agent_margin");
            $table->string("admin_buy_price");
            $table->string("issued_from");
            $table->string("remarks")->nullable();
            $table->longText("routes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
