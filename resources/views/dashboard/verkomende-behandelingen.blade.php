@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8 text-white">

    <h1 class="text-3xl font-bold mb-6">
        Verkomende Behandelingen
    </h1>

    @if($message)
        <div class="mb-6 rounded-lg bg-blue-600 px-4 py-3 text-sm font-medium shadow">
            {{ $message }}
        </div>
    @endif

    @if(count($rows) > 0)
        <div class="rounded-2xl bg-gray-900 shadow-xl ring-1 ring-gray-800 overflow-hidden">
            <table class="w-full border-collapse text-sm">
                <thead class="bg-gray-800 text-gray-300">
                    <tr>
                        <th class="px-5 py-4 text-left font-semibold">Behandelaar</th>
                        <th class="px-5 py-4 text-left font-semibold">Datum</th>
                        <th class="px-5 py-4 text-left font-semibold">Tijd</th>
                        <th class="px-5 py-4 text-left font-semibold">Afspraak</th>
                        <th class="px-5 py-4 text-left font-semibold">Behandeling</th>
                        <th class="px-5 py-4 text-left font-semibold">Status</th>
                        <th class="px-5 py-4 text-left font-semibold">Opmerking</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">
                    @foreach($rows as $r)
                        <tr class="odd:bg-gray-900 even:bg-gray-800/40 hover:bg-gray-800 transition">
                            <td class="px-5 py-4 font-medium">
                                {{ $r->voornaam }} {{ $r->tussenvoegsel }} {{ $r->achternaam }}
                            </td>

                            <td class="px-5 py-4">
                                {{ \Carbon\Carbon::parse($r->date)->format('d-m-Y') }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $r->tijd ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-gray-300">
                                {{ $r->afspraak ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-gray-300">
                                {{ $r->behandeling ?? '-' }}
                            </td>

                            <td class="px-5 py-4">
                                <span class="inline-flex items-center rounded-full
                                    bg-green-500/20 px-3 py-1 text-xs font-semibold text-green-400">
                                    {{ $r->status }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-gray-400 max-w-xs truncate">
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
