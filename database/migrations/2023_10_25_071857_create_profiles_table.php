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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id('profile_id');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('ethnicity', 255)->nullable();
            $table->string('personality', 255)->nullable();
            $table->string('occupation', 255)->nullable();
            $table->text('hobbies')->nullable();
            $table->string('relationship_status', 255)->nullable();
            $table->text('body_description')->nullable();
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
