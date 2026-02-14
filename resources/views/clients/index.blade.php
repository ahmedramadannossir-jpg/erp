@extends('partials.layout')

@section('content')
<h1>Clients</h1>
<a href="{{ route('clients.create') }}">Add client</a>
<table>
<tr><th>Name</th><th>Phone</th><th>Address</th><th>Code</th><th>Public</th><th>Actions</th></tr>
@foreach($clients as $client)
<tr>
<td>{{ $client->name }}</td><td>{{ $client->phone }}</td><td>{{ $client->address }}</td><td>{{ $client->unique_code }}</td>
<td><a href="{{ route('public.clients.show', $client->unique_code) }}" target="_blank">Open</a></td>
<td>
<a href="{{ route('clients.edit', $client) }}">Edit</a>
<form method="POST" action="{{ route('clients.destroy', $client) }}" style="display:inline">@csrf @method('DELETE')<button>Delete</button></form>
</td>
</tr>
@endforeach
</table>
{{ $clients->links() }}
@endsection
