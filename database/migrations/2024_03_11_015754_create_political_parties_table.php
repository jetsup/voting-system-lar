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
        Schema::create("political_parties", function (Blueprint $table) {
            $table->id();
            $table->string("party")->unique();
            $table->string("slogan")->nullable(false);
            $table->foreignId("party_leader")->nullable()->constrained("users")->nullOnDelete()->cascadeOnUpdate();
            $table->string("party_image")->nullable()->default("images/elections/political_parties.jpg");
            // election_id is necessary so that we don't fetch parties of the past that are not contesting
            $table->foreignId("election_id")->nullable()->default(null)->constrained("elections")->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("political_parties");
    }
};
