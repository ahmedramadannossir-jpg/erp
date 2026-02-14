<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use Illuminate\Http\RedirectResponse;

class InstallmentController extends Controller
{
    public function markPaid(Installment $installment): RedirectResponse
    {
        $installment->update(['status' => 'paid']);

        return back()->with('success', 'Installment marked as paid.');
    }
}
