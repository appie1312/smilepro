<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Beschikbaarheid Wijzigen</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('employees.availability.update', $availability) }}">
                    @csrf @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Medewerker</label>
                        <select name="user_id" class="border-gray-300 rounded-md w-full mt-1">
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ $availability->user_id == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label>Datum vanaf</label>
                            <input type="date" name="date_from" value="{{ $availability->date_from }}" required class="border-gray-300 rounded-md w-full">
                        </div>
                        <div>
                            <label>Datum tot</label>
                            <input type="date" name="date_to" value="{{ $availability->date_to }}" required class="border-gray-300 rounded-md w-full">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label>Tijd vanaf</label>
                            <input type="time" name="time_from" value="{{ \Carbon\Carbon::parse($availability->time_from)->format('H:i') }}" required class="border-gray-300 rounded-md w-full">
                        </div>
                        <div>
                            <label>Tijd tot</label>
                            <input type="time" name="time_to" value="{{ \Carbon\Carbon::parse($availability->time_to)->format('H:i') }}" required class="border-gray-300 rounded-md w-full">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label>Status</label>
                        <select name="status" class="border-gray-300 rounded-md w-full">
                            @foreach(['Aanwezig', 'Afwezig', 'Verlof', 'Ziek'] as $stat)
                                <option value="{{ $stat }}" {{ $availability->status == $stat ? 'selected' : '' }}>{{ $stat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Opmerking</label>
                        <textarea name="comment" class="border-gray-300 rounded-md w-full">{{ $availability->comment }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-500">Opslaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>