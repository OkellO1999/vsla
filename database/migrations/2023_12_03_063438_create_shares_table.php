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
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
            $table->float('shareAmount');
            $table->timestamps();
        });
        Schema::table('shares', function( Blueprint $table){
            $table->foreignId('group_id')->constrained();
        });
        Schema::table('shares', function( Blueprint $table){
            $table->foreignId('user_id')->unique()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shares');
    }
};
