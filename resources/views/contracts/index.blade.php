@extends('partials.layout')

@section('content')
<h1>Contracts</h1>
<a href="{{ route('contracts.create') }}">New contract</a>
<form>
<select name="client_id"><option value="">All clients</option>@foreach($clients as $client)<option value="{{ $client->id }}">{{ $client->name }}</option>@endforeach</select>
<button>Filter</button>
</form>
<table>
<tr><th>Client</th><th>Product</th><th>Total</th><th>Installment</th><th>Count</th><th></th></tr>
@foreach($contracts as $contract)
<tr>
<td>{{ $contract->client->name }}</td><td>{{ $contract->product_name }}</td><td>{{ $contract->total_after_profit }}</td><td>{{ $contract->installment_value }}</td><td>{{ $contract->installments_count }}</td>
<td><a href="{{ route('contracts.show', $contract) }}">Details</a></td>
</tr>
@endforeach
</table>
{{ $contracts->links() }}
@endsection
