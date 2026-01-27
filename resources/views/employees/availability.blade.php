<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Beschikbaarheid: {{ $employee->name }}
            </h2>
            @php $role = strtolower(trim(auth()->user()->rolename)); @endphp
            @if($role === 'praktijkmanagement' || $role === 'admin')
                <a href="{{ route('employees.availability.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md text-xs uppercase font-semibold">
                    + Nieuwe Regel
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($hasAvailability)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Datum</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tijd</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Opmerking</th>
                                <th class="px-6 py-3">Acties</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($availabilities as $availability)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($availability->date_from)->format('d-m-Y') }} 
                                        @if($availability->date_from != $availability->date_to)
                                            t/m {{ \Carbon\Carbon::parse($availability->date_to)->format('d-m-Y') }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($availability->time_from)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($availability->time_to)->format('H:i') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $availability->status }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $availability->comment }}</td>
                                    <td class="px-6 py-4 text-sm font-medium flex space-x-3">
                                        @php $role = strtolower(trim(auth()->user()->rolename)); @endphp
                                        @if($role === 'praktijkmanagement' || $role === 'admin')
                                            <a href="{{ route('employees.availability.edit', $availability) }}" class="text-indigo-600 hover:text-indigo-900">Wijzigen</a>
                                            <form action="{{ route('employees.availability.destroy', $availability) }}" method="POST" onsubmit="return confirm('Verwijderen?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Verwijderen</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-gray-500 mt-4">Geen beschikbaarheid gevonden.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>