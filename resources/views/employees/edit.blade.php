<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Medewerker Bewerken</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('employees.update', $employee) }}">
                    @csrf
                    @method('PUT') 

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Naam</label>
                        <input type="text" name="name" value="{{ old('name', $employee->name) }}" required class="border-gray-300 rounded-md w-full mt-1">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">E-mail</label>
                        <input type="email" name="email" value="{{ old('email', $employee->email) }}" required class="border-gray-300 rounded-md w-full mt-1">
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Rol</label>
                        <select name="rolename" required class="border-gray-300 rounded-md w-full mt-1">
                            @foreach(['Tandarts', 'Mondhygiënist', 'Assistent', 'Praktijkmanagement'] as $role)
                                <option value="{{ $role }}" {{ $employee->rolename == $role ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-500">Opslaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>