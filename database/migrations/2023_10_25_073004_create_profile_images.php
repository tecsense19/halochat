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
        Schema::create('profile_images', function (Blueprint $table) {
            $table->id('image_id');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->string('image_path', 255)->nullable();
            $table->tinyInteger('is_primary')->default(0);
            $table->timestamps(0);
        });

        // Define foreign key constraint for profile_id
        Schema::table('profile_images', function (Blueprint $table) {
            $table->foreign('profile_id')->references('profile_id')->on('profiles')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
