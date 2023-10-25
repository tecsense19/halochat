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
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('gender', 255)->default('male');
            $table->string('email', 255)->unique();
            $table->integer('email_verified')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('google_id', 255)->nullable();
            $table->string('user_avatar', 500)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('role', 255)->nullable();
            $table->enum('plans', ['Free', 'premium'])->default('Free');
            $table->timestamps();
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
