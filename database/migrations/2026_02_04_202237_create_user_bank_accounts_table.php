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
        Schema::create('user_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('bank_name')->default('DigiBank International');
            $table->string('account_name');
            $table->string('account_number')->unique();
            $table->string('routing_number');
            $table->string('swift_code');
            $table->string('iban')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('branch_name')->default('Main Branch');
            $table->string('account_type')->default('Savings');
            $table->string('currency')->default('USD');
            $table->boolean('is_primary')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();
            
            $table->index(['user_id', 'is_primary']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_bank_accounts');
    }
};
