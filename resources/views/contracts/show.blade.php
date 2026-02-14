@extends('partials.layout')

@section('content')
<h1>Contract #{{ $contract->id }}</h1>
<p>Client: {{ $contract->client->name }}</p>
<p>Remaining: {{ number_format($contract->remaining_amount,2) }}</p>
<table>
<tr><th>#</th><th>Due Date</th><th>Amount</th><th>Status</th><th></th></tr>
@foreach($contract->installments as $installment)
<tr>
<td>{{ $installment->installment_number }}</td>
<td>{{ $installment->due_date->format('Y-m-d') }}</td>
<td>{{ $installment->amount }}</td>
<td>{{ $installment->status }}</td>
<td>
@if($installment->status !== 'paid')
<form method="POST" action="{{ route('installments.paid', $installment) }}">@csrf @method('PATCH')<button>Mark paid</button></form>
@endif
</td>
</tr>
@endforeach
</table>
@endsection
