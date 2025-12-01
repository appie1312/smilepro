<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Aantal afspraken bekijken
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Statistiek kaarten --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-100 border border-blue-200 rounded-xl shadow-sm p-6">
                    <p class="text-sm text-blue-800">Totaal afspraken</p>
                    <p class="mt-2 text-3xl font-bold text-blue-900">
                        {{ $totalAppointments }}
                    </p>
                </div>

                <div class="bg-orange-100 border border-orange-200 rounded-xl shadow-sm p-6">
                    <p class="text-sm text-orange-800">Afspraken vandaag</p>
                    <p class="mt-2 text-3xl font-bold text-orange-900">
                        {{ $todayAppointments }}
                    </p>
                </div>

                <div class="bg-yellow-100 border border-yellow-200 rounded-xl shadow-sm p-6">
                    <p class="text-sm text-yellow-800">Komende afspraken</p>
                    <p class="mt-2 text-3xl font-bold text-yellow-900">
                        {{ $upcomingAppointments }}
                    </p>
                </div>
            </div>

            {{-- Afspraken laatste 7 dagen --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Afspraken laatste 7 dagen
                </h3>

                @if($last7Days->isEmpty())
                    <p class="text-gray-500 text-sm">
                        Geen afspraken gevonden.
                    </p>
                @else
                    <div class="grid grid-cols-2 md:grid-cols-7 gap-4">
                        @foreach($last7Days as $day)
                            <div class="text-center">
                                <div class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($day->day)->format('d-m') }}
                                </div>
                                <div class="mt-1 text-xl font-semibold">
                                    {{ $day->total }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
