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
        Schema::dropIfExists('notifications');
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('notificationID');
            $table->text('description');
            $table->boolean('isread');
            $table->unsignedBigInteger('furparentID');
            $table->timestamps();

            $table->foreign('furparentID')
                ->references('id')->on('furparents')
                ->onDelete('cascade');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
