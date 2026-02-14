<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PublicClientController extends Controller
{
    public function show(string $token): View
    {
        $client = Client::query()
            ->where('unique_code', $token)
            ->with(['contracts.installments'])
            ->firstOrFail();

        $contracts = $client->contracts;
        $remaining = $contracts->sum->remaining_amount;
        $nextInstallment = $contracts->flatMap->installments
            ->whereIn('status', ['pending', 'late'])
            ->sortBy('due_date')
            ->first();

        $qrCodeSvg = QrCode::size(120)->generate(route('public.clients.show', $client->unique_code));

        return view('public.client', compact('client', 'contracts', 'remaining', 'nextInstallment', 'qrCodeSvg'));
    }
}
