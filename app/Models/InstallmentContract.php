<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class InstallmentContract extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'product_name',
        'total_price',
        'profit_type',
        'profit_value',
        'total_after_profit',
        'down_payment',
        'installment_value',
        'installments_count',
        'delivery_date',
        'first_installment_date',
        'first_installment_mode',
    ];

    protected $casts = [
        'delivery_date' => 'date',
        'first_installment_date' => 'date',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class, 'contract_id');
    }

    public function getRemainingAmountAttribute(): float
    {
        $paid = $this->installments()->where('status', 'paid')->sum('amount');

        return max(($this->total_after_profit - $this->down_payment) - $paid, 0);
    }

    public function getExpectedProfitAttribute(): float
    {
        if ($this->profit_type === 'percent') {
            return round(($this->total_price * $this->profit_value) / 100, 2);
        }

        return (float) $this->profit_value;
    }

    public static function resolveFirstInstallmentDate(string $mode, Carbon $deliveryDate, ?Carbon $manualDate): Carbon
    {
        return $mode === 'manual' && $manualDate ? $manualDate : $deliveryDate->copy()->addMonth();
    }
}
