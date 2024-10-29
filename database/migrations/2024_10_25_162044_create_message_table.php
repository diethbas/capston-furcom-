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
        Schema::dropIfExists('messages');
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('messageID');
            $table->unsignedBigInteger('threadID');
            $table->unsignedBigInteger('senderID');
            $table->text('message');
            $table->timestamps();

            $table->foreign('threadID')
                  ->references('threadID')->on('threads')
                  ->onDelete('cascade');   

            $table->foreign('senderID')
                ->references('id')->on('furparents')
                ->onDelete('cascade');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // if (Schema::hasTable('messages')){
        //     Schema::table('messages', function (Blueprint $table) {
        //         if (Schema::hasColumn('messages', 'threadID')) {
        //             $table->dropForeign(['threadID']);  
        //         }
        //         if (Schema::hasColumn('messages', 'senderID')) {
        //             $table->dropForeign(['threadID']);  
        //         }
        //     });
        // }
        Schema::dropIfExists('threads');
        Schema::dropIfExists('messages');
    }
};
