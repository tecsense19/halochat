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
        Schema::create('managecredit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('currentcredit')->nullable();
            $table->string('usedcredit')->nullable();
            $table->string('totalcredit')->nullable();
            $table->timestamps();
        });

        Schema::table('managecredit', function (Blueprint $table) {
        // Add the primary key
        $table->primary('id');

        // Add a secondary index
        $table->index('user_id');
     });
    }

    public function down()
    {
        Schema::dropIfExists('managecredit');
    }
};
