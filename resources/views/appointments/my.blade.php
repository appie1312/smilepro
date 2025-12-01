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
                    <p class="text-gray-500 text-sm">
                        Je hebt momenteel geen ingeplande afspraken.
                    </p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">Naam patiënt</th>
                                    <th class="border px-4 py-2 text-left">Datum</th>
                                    <th class="border px-4 py-2 text-left">Tijd</th>
                                    <th class="border px-4 py-2 text-left">Telefoon</th>
                                    <th class="border px-4 py-2 text-left">Adres</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">{{ $appointment->customer_name }}</td>
                                        <td class="border px-4 py-2">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y') }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                        </td>
                                        <td class="border px-4 py-2">{{ $appointment->phone }}</td>
                                        <td class="border px-4 py-2">{{ $appointment->address }}</td>
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
