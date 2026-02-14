<?php

namespace App\Services;

use App\Models\Installment;
use App\Models\InstallmentContract;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class InstallmentGenerationService
{
    public function calculateTotalAfterProfit(float $totalPrice, string $profitType, float $profitValue): float
    {
        $profit = $profitType === 'percent' ? ($totalPrice * $profitValue / 100) : $profitValue;

        return round($totalPrice + $profit, 2);
    }

    public function generate(InstallmentContract $contract): void
    {
        if ($contract->installments()->exists()) {
            return;
        }

        DB::transaction(function () use ($contract): void {
            $baseDate = Carbon::parse($contract->first_installment_date);
            for ($i = 1; $i <= $contract->installments_count; $i++) {
                Installment::query()->create([
                    'contract_id' => $contract->id,
                    'installment_number' => $i,
                    'due_date' => $baseDate->copy()->addMonths($i - 1),
                    'amount' => $contract->installment_value,
                    'status' => 'pending',
                ]);
            }
        });
    }
}
