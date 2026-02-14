<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Models\Client;
use App\Models\InstallmentContract;
use App\Services\InstallmentGenerationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class InstallmentContractController extends Controller
{
    public function __construct(private readonly InstallmentGenerationService $installments)
    {
    }

    public function index(Request $request): View
    {
        $contracts = InstallmentContract::query()
            ->with('client')
            ->when($request->filled('client_id'), fn ($q) => $q->where('client_id', $request->integer('client_id')))
            ->latest()
            ->paginate(15);

        $clients = Client::query()->orderBy('name')->get();

        return view('contracts.index', compact('contracts', 'clients'));
    }

    public function create(): View
    {
        $clients = Client::query()->orderBy('name')->get();

        return view('contracts.create', compact('clients'));
    }

    public function store(StoreContractRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $totalAfterProfit = $this->installments->calculateTotalAfterProfit((float) $data['total_price'], $data['profit_type'], (float) $data['profit_value']);
        $firstDate = InstallmentContract::resolveFirstInstallmentDate(
            $data['first_installment_mode'],
            Carbon::parse($data['delivery_date']),
            ! empty($data['first_installment_date']) ? Carbon::parse($data['first_installment_date']) : null,
        );

        $remaining = $totalAfterProfit - (float) $data['down_payment'];
        $installmentValue = round($remaining / (int) $data['installments_count'], 2);

        $contract = InstallmentContract::query()->create([
            ...$data,
            'total_after_profit' => $totalAfterProfit,
            'first_installment_date' => $firstDate,
            'installment_value' => $installmentValue,
        ]);

        $this->installments->generate($contract);

        return redirect()->route('contracts.show', $contract)->with('success', 'Contract created and installments generated.');
    }

    public function show(InstallmentContract $contract): View
    {
        $contract->load(['client', 'installments']);

        return view('contracts.show', compact('contract'));
    }
}
