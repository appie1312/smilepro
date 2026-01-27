<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beschikbaarheid van ' . $employee->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($hasAvailability)
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Overzicht Inzetbaarheid</h3>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Datum (Van - Tot)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tijd (Van - Tot)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Opmerking</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inzetbaarheid</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($availabilities as $availability)
                                @php
                                    // Bepaal de kleur op basis van de status
                                    $color = [
                                        'Aanwezig' => 'bg-green-100 text-green-800',
                                        'Afwezig' => 'bg-yellow-100 text-yellow-800',
                                        'Verlof' => 'bg-blue-100 text-blue-800',
                                        'Ziek' => 'bg-red-100 text-red-800',
                                    ][$availability->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($availability->date_from)->format('d-m-Y') }} - 
                                        {{ \Carbon\Carbon::parse($availability->date_to)->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($availability->time_from)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($availability->time_to)->format('H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                            {{ $availability->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $availability->comment ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm font-medium">
                                        @if ($availability->status == 'Aanwezig')
                                            <span class="text-green-600 font-bold">INZETBAAR</span>
                                        @else
                                            <span class="text-red-600">NIET INZETBAAR</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(strtolower(auth()->user()->rolename) === 'praktijkmanagement' || strtolower(auth()->user()->rolename) === 'admin')
                                            <form action="{{ route('employees.availability.destroy', $availability) }}" method="POST" onsubmit="return confirm('Verwijderen?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Verwijderen</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-10 border border-dashed border-gray-300 rounded-lg">
                        <svg class="mx-auto h-12 w-12 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-red-900">Geen beschikbare informatie</h3>
                        <p class="mt-1 text-sm text-red-500">
                            **Er is geen beschikbaarheid ingevoerd voor deze medewerker.**
                        </p>
                    </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('employees.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                        &larr; Terug naar Medewerkersoverzicht
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>