<x-app-layout>
    {{-- 
        We definiëren de rol één keer bovenaan, veilig en schoon (kleine letters, geen spaties).
        Dit voorkomt fouten als er 'Praktijk Management' in de database staat.
    --}}
    @php
        $currentRole = strtolower(trim(auth()->user()->rolename ?? ''));
    @endphp

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Medewerkersoverzicht') }}
            </h2>

            {{-- Alleen Management ziet de knop 'Toevoegen' --}}
            @if($currentRole === 'praktijkmanagement' || $currentRole === 'admin')
                <a href="{{ route('employees.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    + Nieuwe Medewerker
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($hasEmployees)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Naam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($employees as $employee)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $employee->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $employee->rolename }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $employee->email }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center space-x-4">
                                        {{-- IEDEREEN mag het rooster zien --}}
                                        <a href="{{ route('employees.availability', $employee) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Rooster</a>
                                        
                                        {{-- ALLEEN MANAGEMENT ziet Bewerken & Verwijderen --}}
                                        @if($currentRole === 'praktijkmanagement' || $currentRole === 'admin')
                                            
                                            <a href="{{ route('employees.edit', $employee) }}" class="text-yellow-600 hover:text-yellow-900">Bewerken</a>

                                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je {{ $employee->name }} wilt verwijderen?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 cursor-pointer ml-2">
                                                    Verwijderen
                                                </button>
                                            </form>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-10">
                        <p class="mt-1 text-sm text-gray-500">Er zijn geen medewerkers gevonden.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>