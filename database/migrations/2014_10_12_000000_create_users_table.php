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
        Schema::create("users", function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("middle_name")->nullable()->default(null);
            $table->bigInteger("id_number", false, true)->unique();
            $table->foreignId("gender_id")->nullable()->constrained("genders")->nullOnDelete()->cascadeOnUpdate();
            $table->date("dob")->nullable(false);
            $table->foreignId("constituency_id")->nullable()->constrained("constituencies")->nullOnDelete()->cascadeOnUpdate();
            $table->string("ward")->nullable(false);
            $table->string("email")->unique();
            $table->string("phone")->unique();
            $table->foreignId("user_type_id")->default(2)->nullable()->constrained("user_types")->nullOnDelete()->cascadeOnUpdate();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password");
            $table->string("dp")->nullable()->default("/images/user.png");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("users");
    }
};
