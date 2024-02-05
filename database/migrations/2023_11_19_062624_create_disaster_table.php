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
        Schema::create('disaster', function (Blueprint $table) {
            $table->id();
            $table->float('disaster_amount_paid');
            $table->timestamps();
        });
        Schema::table('disaster', function (Blueprint $table){
            $table->foreignId('user_id')->unique()->constrained();
        });
        Schema::table('disaster', function (Blueprint $table){
            $table->foreignId('group_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disaster');
    }
};
