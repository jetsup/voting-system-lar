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
        Schema::create("candidates", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable()->constrained("users")->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId("vie_position_id")->nullable()->constrained("political_positions")->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId("party_id")->nullable()->constrained("political_parties")->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId("election_id")->nullable()->constrained("elections")->nullOnDelete()->cascadeOnUpdate();
            $table->string("affidavit")->nullable()->default(null);
            // votes counter
            $table->integer("total_votes")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("candidates");
    }
};
