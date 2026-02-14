<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('installment_contracts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->string('product_name');
            $table->decimal('total_price', 12, 2);
            $table->enum('profit_type', ['percent', 'fixed']);
            $table->decimal('profit_value', 12, 2);
            $table->decimal('total_after_profit', 12, 2);
            $table->decimal('down_payment', 12, 2);
            $table->decimal('installment_value', 12, 2);
            $table->unsignedInteger('installments_count');
            $table->date('delivery_date');
            $table->date('first_installment_date');
            $table->enum('first_installment_mode', ['auto', 'manual']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('installment_contracts');
    }
};
