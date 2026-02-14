<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('installments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('contract_id')->constrained('installment_contracts')->cascadeOnDelete();
            $table->unsignedInteger('installment_number');
            $table->date('due_date');
            $table->decimal('amount', 12, 2);
            $table->enum('status', ['pending', 'paid', 'late'])->default('pending');
            $table->timestamps();

            $table->unique(['contract_id', 'installment_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
