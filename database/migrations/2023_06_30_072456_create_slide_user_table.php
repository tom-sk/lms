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
        Schema::create('slide_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBiginteger('user_id')->unsigned();
            $table->unsignedBiginteger('slide_id')->unsigned();
            $table->boolean('slide_complete')->default(false)->nullable();

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('slide_id')->references('id')
                ->on('slides')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slide_user');
    }
};
