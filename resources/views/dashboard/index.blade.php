@extends('partials.layout')

@section('content')
<h1>Dashboard</h1>
<div class="cards">
    <div class="card">Clients: {{ $stats['clients_count'] }}</div>
    <div class="card">Late clients: {{ $stats['late_clients'] }}</div>
    <div class="card">Total profit: {{ number_format($stats['total_profit'],2) }}</div>
    <div class="card">Due installments: {{ $stats['due_installments'] }}</div>
</div>
@endsection
