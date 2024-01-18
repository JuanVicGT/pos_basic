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
        Schema::create('users', function (Blueprint $table) {

            //// Required
            $table->id();
            $table->timestamps();
            $table->rememberToken();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('username')->unique(); // Use to login

            //// Nullable
            $table->string('photo')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('admin')->nullable();
            $table->string('printer')->nullable();
            $table->timestamp('email_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
