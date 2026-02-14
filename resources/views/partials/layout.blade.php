<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Click Store Installments</title>
    <style>
        body{font-family:Arial,sans-serif;max-width:1100px;margin:20px auto;padding:0 12px}table{width:100%;border-collapse:collapse}th,td{border:1px solid #ddd;padding:8px}.cards{display:grid;grid-template-columns:repeat(4,1fr);gap:10px}.card{padding:12px;border:1px solid #ddd;border-radius:8px}a{margin-right:8px}
    </style>
</head>
<body>
<nav>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('clients.index') }}">Clients</a>
    <a href="{{ route('contracts.index') }}">Contracts</a>
</nav>
@if(session('success'))<p>{{ session('success') }}</p>@endif
@yield('content')
</body>
</html>
