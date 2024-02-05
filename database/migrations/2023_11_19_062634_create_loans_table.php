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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->float('loanAmount');
            $table->date('issueDate');
            $table->date('dueDate');
            $table->integer('interestRate');
            $table->float('interestAmount');
            $table->float('payBackAmount');
            $table->float('balance');
            $table->float('loanType');
            $table->string('userType')->default('member');
            $table->string('loanStatus')->default('pending');
            $table->timestamps();
        });

       Schema::table('loans', function(Blueprint $table){
        $table->foreignId('group_id')->constrained();
       });
       Schema::table('loans', function(Blueprint $table){
        $table->foreignId('user_id')->constrained();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
