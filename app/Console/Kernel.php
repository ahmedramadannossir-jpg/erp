<?php

namespace App\Console;

use App\Console\Commands\MarkLateInstallmentsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        MarkLateInstallmentsCommand::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('installments:mark-late')->daily();
    }
}
