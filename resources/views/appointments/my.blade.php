<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mijn afspraken
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Afspraken met mijn patiënten
                </h3>

                @if($appointments->isEmpty())
                    <p class="text-gray-500 text-sm">Je hebt momenteel geen ingeplande afspraken.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">Naam patiënt</th>
                                    <th class="border px-4 py-2 text-left">Datum</th>
                                    <th class="border px-4 py-2 text-left">Tijd</th>
                                    <th class="border px-4 py-2 text-left">Status</th>
                                    <th class="border px-4 py-2 text-left">Opmerking</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">
                                            {{ $appointment->patient?->person?->voornaam }} {{ $appointment->patient?->person?->achternaam }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            {{ $appointment->datum ? \Carbon\Carbon::parse($appointment->datum)->format('d-m-Y') : '-' }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            {{ $appointment->tijd ? \Carbon\Carbon::parse($appointment->tijd)->format('H:i') : '-' }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            <span class="px-2 py-1 text-xs rounded
                                                {{ $appointment->status === 'Bevestigd' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $appointment->status }}
                                            </span>
                                        </td>
                                        <td class="border px-4 py-2">{{ $appointment->opmerking ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
