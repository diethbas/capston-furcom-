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
        Schema::dropIfExists('furbabies');
        Schema::create('furbabies', function (Blueprint $table) {
            $table->bigIncrements('furbabyID');
            $table->string('name');
            $table->integer('age');
            $table->text('description');
            $table->string('img');
            $table->unsignedBigInteger('furparentID');
            $table->timestamps();
            
            $table->foreign('furparentID')
                ->references('id')->on('furparents')
                ->onDelete('cascade');   
        });

        Schema::table('medias', function(Blueprint $table) {
            $table->foreign('furbabyID')
                ->references('furbabyID')->on('furbabies')
                ->onDelete('cascade');   
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
        Schema::dropIfExists('furbabies');
    }
};
