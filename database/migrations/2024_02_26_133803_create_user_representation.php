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
        Schema::create('user_representation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('representation_id');
            
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('representation_id')->references('id')->on('representations')
                    ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_representation');
    }
};
