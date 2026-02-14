@extends('partials.layout')

@section('content')
<h1>Create Contract</h1>
<form method="POST" action="{{ route('contracts.store') }}">
@csrf
<select name="client_id" required>@foreach($clients as $client)<option value="{{ $client->id }}">{{ $client->name }}</option>@endforeach</select>
<input name="product_name" placeholder="Product name" required>
<input type="number" step="0.01" name="total_price" placeholder="Total price" required>
<select name="profit_type"><option value="percent">Percent</option><option value="fixed">Fixed</option></select>
<input type="number" step="0.01" name="profit_value" placeholder="Profit value" required>
<input type="number" step="0.01" name="down_payment" placeholder="Down payment" required>
<input type="number" name="installments_count" placeholder="Installments count" required>
<label>Delivery date<input type="date" name="delivery_date" required></label>
<select name="first_installment_mode"><option value="auto">Auto</option><option value="manual">Manual</option></select>
<label>Manual first installment<input type="date" name="first_installment_date"></label>
<button>Save contract</button>
</form>
@endsection
