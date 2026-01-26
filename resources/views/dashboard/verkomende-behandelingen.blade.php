@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8 text-white">

    {{-- Titel --}}
    <h1 class="text-3xl font-semibold mb-6">
        Verkomende Behandelingen
    </h1>

    {{-- Info / empty message --}}
    @if($message)
        <div class="mb-6 rounded-lg bg-blue-600/90 px-4 py-3 text-sm font-medium">
            {{ $message }}
        </div>
    @endif

    {{-- Tabel --}}
    @if(count($rows) > 0)
        <div class="overflow-x-auto rounded-xl border border-gray-800 bg-gray-900 shadow">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-800 text-gray-300 uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left">Behandelaar</th>
                        <th class="px-4 py-3 text-left">Datum</th>
                        <th class="px-4 py-3 text-left">Tijd</th>
                        <th class="px-4 py-3 text-left">Afspraak</th>
                        <th class="px-4 py-3 text-left">Behandeling</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Opmerking</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">
                    @foreach($rows as $r)
                        <tr class="hover:bg-gray-800/60 transition">
                            <td class="px-4 py-3 font-medium">
                                {{ $r->voornaam }}
                                {{ $r->tussenvoegsel }}
                                {{ $r->achternaam }}
                            </td>

                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($r->date)->format('d-m-Y') }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $r->tijd ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-gray-300">
                                {{ $r->afspraak ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-gray-300">
                                {{ $r->behandeling ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full
                                    bg-green-600/20 px-3 py-1 text-xs font-semibold text-green-400">
                                    {{ $r->status }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-gray-400">
                                {{ $r->opmerking ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
