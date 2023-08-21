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
        Schema::create('resource_topic', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBiginteger('topic_id')->unsigned();
            $table->unsignedBiginteger('resource_id')->unsigned();
            $table->integer('sort_order')->nullable();

            $table->foreign('topic_id')->references('id')
                ->on('topics')->onDelete('cascade');
            $table->foreign('resource_id')->references('id')
                ->on('resources')->onDelete('cascade');
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_topic');
    }
};
