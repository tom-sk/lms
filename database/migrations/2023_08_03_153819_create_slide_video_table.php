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
        Schema::create('slide_video', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBiginteger('slide_id')->unsigned();
            $table->unsignedBiginteger('video_id')->unsigned();
            $table->integer('sort_order')->nullable();
            $table->foreign('slide_id')->references('id')
                ->on('slides')->onDelete('cascade');
            $table->foreign('video_id')->references('id')
                ->on('videos')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slide_video');
    }
};
