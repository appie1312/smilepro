@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 text-white">
    <h1 class="text-2xl font-bold mb-4">Verkomende Behandelingen</h1>

    @if($message)
        <div class="bg-blue-600 p-3 rounded mb-4">
            {{ $message }}
        </div>
    @endif

    @if(count($rows) > 0)
        <table class="min-w-full bg-gray-900 rounded">
            <thead>
                <tr>
                    <th class="p-3 text-left">Behandelaar</th>
                    <th class="p-3 text-left">Datum</th>
                    <th class="p-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $r)
                    <tr class="border-b border-gray-800">
                        <td class="p-3">{{ $r->voornaam }} {{ $r->tussenvoegsel }} {{ $r->achternaam }}</td>
                        <td class="p-3">{{ $r->date }}</td>
                        <td class="p-3">{{ $r->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
