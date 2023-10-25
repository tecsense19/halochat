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
        Schema::create('plans', function (Blueprint $table) {
            $table->id('Plan_id');
            $table->string('Plan_name', 255);
            $table->decimal('Plan_price', 10, 2);
            $table->integer('Trail_period_days')->nullable();
            $table->enum('Interval', ['month', 'year', 'week', 'day']);
            $table->text('Description')->nullable();
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
