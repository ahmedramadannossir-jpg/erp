<?php

namespace App\Console\Commands;

use App\Models\Installment;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class MarkLateInstallmentsCommand extends Command
{
    protected $signature = 'installments:mark-late';

    protected $description = 'Mark overdue pending installments as late';

    public function handle(): int
    {
        $count = Installment::query()
            ->where('status', 'pending')
            ->whereDate('due_date', '<', Carbon::today())
            ->update(['status' => 'late']);

        $this->info("{$count} installments marked as late.");

        return self::SUCCESS;
    }
}
