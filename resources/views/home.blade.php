<!doctype html>
<html>
<head><meta charset="utf-8"><title>Home</title></head>
<body>
    <h1>Homepagina</h1>

    @auth
        <p>Je bent ingelogd. Ga naar <a href="{{ route('overzicht') }}">Overzicht</a></p>
    @else
        <p><a href="/login">Inloggen</a></p>
    @endauth
</body>
</html>
