<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Management – Afspraken beheren
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="mb-4 text-sm text-green-700 bg-green-100 border border-green-200 rounded-lg px-4 py-2">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Afspraken
                </h3>

                @if ($appointments->isEmpty())
                    <p class="text-gray-500 text-sm">Geen afspraken gevonden.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">Naam klant</th>
                                    <th class="border px-4 py-2 text-left">Tijd</th>
                                    <th class="border px-4 py-2 text-left">Datum afspraak</th>
                                    <th class="border px-4 py-2 text-left">Afspraak met</th>
                                    <th class="border px-4 py-2 text-left">Telefoonnummer</th>
                                    <th class="border px-4 py-2 text-left">Adres</th>
                                    <th class="border px-4 py-2 text-left">Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">{{ $appointment->customer_name }}</td>
                                        <td class="border px-4 py-2">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y') }}
                                        </td>
                                        <td class="border px-4 py-2">{{ $appointment->with_whom }}</td>
                                        <td class="border px-4 py-2">{{ $appointment->phone }}</td>
                                        <td class="border px-4 py-2">{{ $appointment->address }}</td>
                                        <td class="border px-4 py-2">
                                            {{-- Later kun je hier een edit-knop toevoegen --}}
                                            <form method="POST"
                                                  action="{{ route('appointments.destroy', $appointment) }}"
                                                  onsubmit="return confirm('Weet je zeker dat je deze afspraak wilt verwijderen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-1 rounded bg-red-500 text-white text-xs hover:bg-red-600">
                                                    Verwijderen
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $appointments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
