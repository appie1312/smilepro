<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwe Medewerker Toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('employees.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">Naam *</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700">E-mailadres *</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block font-medium text-sm text-gray-700">Medewerkertype *</label>
                        <select id="role" name="role" required
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                            <option value="">Kies een rol...</option>
                            <option value="Tandarts" {{ old('role') == 'Tandarts' ? 'selected' : '' }}>Tandarts</option>
                            <option value="Mondhygiënist" {{ old('role') == 'Mondhygiënist' ? 'selected' : '' }}>Mondhygiënist</option>
                            <option value="Assistent" {{ old('role') == 'Assistent' ? 'selected' : '' }}>Assistent</option>
                            <option value="Praktijkmanagement" {{ old('role') == 'Praktijkmanagement' ? 'selected' : '' }}>Praktijkmanagement</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="specialization" class="block font-medium text-sm text-gray-700">Specialisatie (Optioneel)</label>
                        <input id="specialization" type="text" name="specialization" value="{{ old('specialization') }}"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('employees.index') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4">
                            Annuleren
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Opslaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>