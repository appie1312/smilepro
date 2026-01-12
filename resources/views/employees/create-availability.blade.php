<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beschikbaarheid Toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-medium text-gray-900 mb-4">Nieuwe regel toevoegen</h3>

                <form method="POST" action="{{ route('employees.availability.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="user_id" class="block font-medium text-sm text-gray-700">Selecteer Medewerker *</label>
                        <select id="user_id" name="user_id" required
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" 
                                    {{ (auth()->id() == $employee->id) ? 'selected' : '' }}>
                                    {{ $employee->name }} ({{ $employee->rolename }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="date_from" class="block font-medium text-sm text-gray-700">Datum vanaf *</label>
                            <input id="date_from" type="date" name="date_from" value="{{ old('date_from') }}" required
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                        </div>
                        <div>
                            <label for="date_to" class="block font-medium text-sm text-gray-700">Datum tot en met *</label>
                            <input id="date_to" type="date" name="date_to" value="{{ old('date_to') }}" required
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                        </div>
                    </div>
                    @error('date_to')
                        <p class="text-red-500 text-xs mb-4">{{ $message }}</p>
                    @enderror

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="time_from" class="block font-medium text-sm text-gray-700">Tijd vanaf *</label>
                            <input id="time_from" type="time" name="time_from" value="{{ old('time_from', '09:00') }}" required
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                        </div>
                        <div>
                            <label for="time_to" class="block font-medium text-sm text-gray-700">Tijd tot en met *</label>
                            <input id="time_to" type="time" name="time_to" value="{{ old('time_to', '17:00') }}" required
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                        </div>
                    </div>
                    @error('time_to')
                        <p class="text-red-500 text-xs mb-4">{{ $message }}</p>
                    @enderror

                    <div class="mb-4">
                        <label for="status" class="block font-medium text-sm text-gray-700">Status *</label>
                        <select id="status" name="status" required
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                            <option value="Aanwezig" {{ old('status') == 'Aanwezig' ? 'selected' : '' }}>Aanwezig</option>
                            <option value="Afwezig" {{ old('status') == 'Afwezig' ? 'selected' : '' }}>Afwezig</option>
                            <option value="Verlof" {{ old('status') == 'Verlof' ? 'selected' : '' }}>Verlof</option>
                            <option value="Ziek" {{ old('status') == 'Ziek' ? 'selected' : '' }}>Ziek</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="comment" class="block font-medium text-sm text-gray-700">Opmerking (Optioneel)</label>
                        <textarea id="comment" name="comment" rows="2"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">{{ old('comment') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Regel Toevoegen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>