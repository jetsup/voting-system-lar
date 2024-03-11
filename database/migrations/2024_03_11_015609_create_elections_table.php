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
        Schema::create("elections", function (Blueprint $table) {
            $table->id();
            // bi elections or general elections
            $table->foreignId("election_type")->nullable()->constrained("election_types")->nullOnDelete()->cascadeOnUpdate();
            /*  bi can be national wide[county && constituency set]
                or on county level[ONLY county set]
                or on constituency level[ONLY constituency set]
            */
            $table->foreignId("county_id")->nullable()->default(null)->constrained("counties")->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId("constituency_id")->nullable()->default(null)->constrained("constituencies")->nullOnDelete()->cascadeOnUpdate();
            $table->dateTime("election_start_date");
            $table->dateTime("election_ends_date");
            $table->foreignId("election_status")->nullable()->constrained("election_status")->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("elections");
    }
};
