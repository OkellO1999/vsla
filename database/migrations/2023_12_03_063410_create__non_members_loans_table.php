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
        Schema::create('_non_members_loans', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('maritalStatus');
            $table->string('occupation');
            $table->string('village');
            $table->string('parish');
            $table->string('subCounty');
            $table->string('district');
            $table->string('NIN');
            $table->string('email');
            $table->string('contact');
            $table->string('LC1Names');
            $table->string('LC1Contacts');
            $table->string('ClanLeaderNames');
            $table->string('ClanLeaderContact');
            $table->float('amountRequested');
            $table->string('reason');
            $table->string('status');
            $table->timestamps();
        });

        Schema::table('_non_members_loans', function(Blueprint $table){
            $table->foreignId('user_id')->constrained();
        });
        Schema::table('_non_members_loans', function(Blueprint $table){
            $table->foreignId('group_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_non_members_loans');
    }
};
