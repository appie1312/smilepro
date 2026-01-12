<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Medewerkersoverzicht') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($hasEmployees)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nr.</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Naam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Medewerkertype</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialisatie</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Is Actief</th>
                                <th class="px-6 py-3">Acties</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($employees as $employee)
                                <tr class="{{ $employee->is_active ? '' : 'bg-red-50 opacity-70' }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $employee->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $employee->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $employee->role }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $employee->specialization ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $employee->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $employee->is_active ? 'Ja' : 'Nee' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-4">Details</a>
                                        <a href="{{ route('employees.availability', $employee) }}" class="text-blue-600 hover:text-blue-900">Beschikbaarheid</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-10">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path d="M17 20h5v-2h-5zM12 20h2v-2h-2zM7 20h3v-2H7zM17 14h5v-2h-5zM12 14h2v-2h-2zM7 14h3v-2H7zM2 8v14h20V8H2zM4 10h16v10H4V10zM12 2l-6 4h12z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Geen medewerkers gevonden</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            **Er zijn geen medewerkers gevonden.**
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>