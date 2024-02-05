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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nin');
            $table->string('contact');
            $table->string('village');
            $table->string('parish');
            $table->string('sub-county');
            $table->string('district');
            $table->string('role');
            $table->string('status');
            $table->boolean('verified')->default(0);
            $table->timestamp('email_verified_at');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('users', function(Blueprint $table){
            $table->foreignId('group_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
