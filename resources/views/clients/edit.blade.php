@extends('partials.layout')

@section('content')
<h1>Edit Client</h1>
<form method="POST" action="{{ route('clients.update', $client) }}">
@csrf @method('PUT')
<input name="name" value="{{ $client->name }}" required>
<input name="phone" value="{{ $client->phone }}" required>
<input name="address" value="{{ $client->address }}">
<button>Update</button>
</form>
@endsection
