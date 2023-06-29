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
        Schema::create('module_topic', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBiginteger('module_id')->unsigned();
            $table->unsignedBiginteger('topic_id')->unsigned();
            $table->integer('sort_order')->nullable();

            $table->foreign('module_id')->references('id')
                ->on('modules')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')
                ->on('topics')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_topic');
    }
};
