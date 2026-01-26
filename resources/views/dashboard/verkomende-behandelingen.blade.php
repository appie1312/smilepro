@if(count($rows) > 0)

    {{-- MOBILE: cards --}}
    <div class="space-y-3 md:hidden">
        @foreach($rows as $r)
            <div class="rounded-2xl bg-gray-900 ring-1 ring-gray-800 p-4 shadow">
                <div class="flex items-start justify-between gap-3">
                    <div class="font-semibold">
                        {{ $r->voornaam }} {{ $r->tussenvoegsel }} {{ $r->achternaam }}
                    </div>

                    <span class="inline-flex items-center rounded-full bg-green-500/20 px-3 py-1 text-xs font-semibold text-green-400">
                        {{ $r->status }}
                    </span>
                </div>

                <div class="mt-3 grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <div class="text-gray-400">Datum</div>
                        <div>{{ \Carbon\Carbon::parse($r->date)->format('d-m-Y') }}</div>
                    </div>

                    <div>
                        <div class="text-gray-400">Tijd</div>
                        <div>{{ $r->tijd ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="text-gray-400">Afspraak</div>
                        <div>{{ $r->afspraak ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="text-gray-400">Behandeling</div>
                        <div>{{ $r->behandeling ?? '-' }}</div>
                    </div>

                    <div class="col-span-2">
                        <div class="text-gray-400">Opmerking</div>
                        <div class="text-gray-300">{{ $r->opmerking ?? '-' }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- DESKTOP/TABLET: table --}}
    <div class="hidden md:block rounded-2xl bg-gray-900 shadow-xl ring-1 ring-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
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
                            <td class="px-5 py-4">{{ $r->tijd ?? '-' }}</td>
                            <td class="px-5 py-4 text-gray-300">{{ $r->afspraak ?? '-' }}</td>
                            <td class="px-5 py-4 text-gray-300">{{ $r->behandeling ?? '-' }}</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center rounded-full bg-green-500/20 px-3 py-1 text-xs font-semibold text-green-400">
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
    </div>

@endif
