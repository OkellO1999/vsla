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
        Schema::create('welfare', function (Blueprint $table) {
            $table->id();
            $table->float('welfare_paid');
            $table->timestamps();
        });
        Schema::table('welfare', function (Blueprint $table){
            $table->foreignId('user_id')->unique()->constrained();
        });
        Schema::table('welfare', function (Blueprint $table){
            $table->foreignId('group_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welfare');
    }
};
