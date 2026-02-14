<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Installment;
use App\Models\InstallmentContract;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            'clients_count' => Client::query()->count(),
            'late_clients' => Client::query()->whereHas('contracts.installments', fn ($q) => $q->where('status', 'late'))->count(),
            'total_profit' => InstallmentContract::query()->get()->sum->expected_profit,
            'due_installments' => Installment::query()->whereIn('status', ['pending', 'late'])->count(),
        ];

        return view('dashboard.index', compact('stats'));
    }
}
