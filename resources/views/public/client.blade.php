@extends('partials.layout')

@section('content')
<h1>{{ $client->name }}</h1>
<p>Remaining total: {{ number_format($remaining, 2) }}</p>
@if($nextInstallment)
<p>Next installment: #{{ $nextInstallment->installment_number }} on {{ $nextInstallment->due_date->format('Y-m-d') }} ({{ $nextInstallment->amount }})</p>
@endif
<div>{!! $qrCodeSvg !!}</div>
@foreach($contracts as $contract)
<h3>{{ $contract->product_name }} - Remaining {{ number_format($contract->remaining_amount,2) }}</h3>
<table>
<tr><th>#</th><th>Due</th><th>Amount</th><th>Status</th></tr>
@foreach($contract->installments as $installment)
<tr>
<td>{{ $installment->installment_number }}</td>
<td>{{ $installment->due_date->format('Y-m-d') }}</td>
<td>{{ $installment->amount }}</td>
<td>{{ $installment->status }}</td>
</tr>
@endforeach
</table>
@endforeach
@endsection
