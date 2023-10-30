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
        Schema::create('messages', function (Blueprint $table) {
            $table->id('message_id');
            $table->integer('profile_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('sender_id')->nullable();
            $table->bigInteger('receiver_id')->nullable();
            $table->enum('status', ['Active', 'Archived', 'Deleted']);
            $table->text('message_text');
            $table->timestamp('timestamp');
            $table->string('media_url', 255)->nullable();
            $table->timestamps(); // This will add 'created_at' and 'updated_at' columns.

            $table->index('user_id');
            $table->index('sender_id');
            $table->index('receiver_id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
