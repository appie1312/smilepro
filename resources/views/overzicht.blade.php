<!doctype html>
<html>
<head><meta charset="utf-8"><title>Overzicht</title></head>
<body>
    <h1>Overzicht</h1>

    <p>Welkom, {{ auth()->user()->name }} ({{ auth()->user()->role }})</p>

    @if(auth()->user()->role === 'praktijkmanagement')
        <a href="{{ route('dashboard.beheren') }}">
            <button>Dashboard beheren</button>
        </a>
    @else
        <p>Je hebt geen management rechten.</p>
    @endif
</body>
</html>
