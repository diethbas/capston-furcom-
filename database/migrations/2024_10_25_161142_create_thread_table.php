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
        Schema::dropIfExists('threads');
        Schema::create('threads', function (Blueprint $table) {
            $table->bigIncrements('threadID');
            $table->integer('recipientID1');
            $table->integer('recipientID2');
            $table->boolean('isread');
            $table->integer('isreadTo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('threads');
    }
};
