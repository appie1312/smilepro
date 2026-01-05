<!doctype html>
<html>
<head><meta charset="utf-8"><title>Omzet bekijken</title></head>
<body>
    <h1>Omzet bekijken</h1>

    @if(count($omzetten) === 0)
        <p>Er zijn geen omzets beschikbaar.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Omschrijving</th>
                    <th>Klant</th>
                    <th>Datum</th>
                    <th>Bedrag</th>
                </tr>
            </thead>
            <tbody>
                @foreach($omzetten as $o)
                    <tr>
                        <td>{{ $o->omschrijving }}</td>
                        <td>{{ $o->klant_naam }}</td>
                        <td>{{ \Carbon\Carbon::parse($o->datum)->format('d-m-Y') }}</td>
                        <td>€ {{ number_format((float)$o->bedrag, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
