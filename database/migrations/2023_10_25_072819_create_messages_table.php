<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->enum('status', ['Active', 'Archived', 'Deleted']);
            $table->text('message_text');
            $table->enum('message_liked', ['Liked', 'Unliked'])->nullable();
            $table->string('feedback')->nullable();
            $table->timestamp('timestamp');
            $table->string('media_url')->nullable();
            $table->integer('isDeleted');
            $table->timestamps();
        });

        // Define primary key and secondary indexes here
        Schema::table('messages', function (Blueprint $table) {
            $table->primary('message_id');
            $table->index('user_id');
            $table->index('sender_id');
            $table->index('receiver_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
