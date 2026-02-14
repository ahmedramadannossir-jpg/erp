<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'address', 'unique_code'];

    protected static function booted(): void
    {
        static::creating(function (Client $client): void {
            if (! $client->unique_code) {
                $client->unique_code = static::generateUniqueCode();
            }
        });
    }

    public static function generateUniqueCode(): string
    {
        do {
            $code = Str::upper(Str::random(12));
        } while (static::query()->where('unique_code', $code)->exists());

        return $code;
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(InstallmentContract::class);
    }
}
