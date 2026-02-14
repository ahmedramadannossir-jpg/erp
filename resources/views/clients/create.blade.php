@extends('partials.layout')

@section('content')
<h1>Add Client</h1>
<form method="POST" action="{{ route('clients.store') }}">
@csrf
<input name="name" placeholder="Name" required>
<input name="phone" placeholder="Phone" required>
<input name="address" placeholder="Address">
<button>Save</button>
</form>
@endsection
