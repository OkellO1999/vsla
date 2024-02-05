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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->float('welfareDefaultAmount')->default(000.00);
            $table->float('disasterDefaultAmount')->default(000.00);
            $table->float('sharesDefaultAmount')->default(000.00);
            $table->integer('membersLoanInterestRate')->default(0);
            $table->integer('nonMembersInterestRate')->default(0);
            $table->integer('guarantorPayRate')->default(0);
            $table->foreignId('group_id')->unique()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
