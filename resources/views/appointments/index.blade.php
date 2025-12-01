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

                <div class="stat-card bg-blue-100 text-blue-900" id="totalAppointmentsBox"></div>
                <div class="stat-card bg-orange-100 text-orange-900" id="todayAppointmentsBox"></div>
                <div class="stat-card bg-yellow-100 text-yellow-900" id="upcomingAppointmentsBox"></div>

            </div>

            {{-- Afspraken laatste 7 dagen --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Afspraken laatste 7 dagen
                </h3>

                <div id="last7DaysContainer" class="grid grid-cols-2 md:grid-cols-7 gap-4"></div>
            </div>

        </div>
    </div>

    {{-- Data naar JavaScript sturen --}}
    <script>
        const statsData = {
            total: @json($totalAppointments),
            today: @json($todayAppointments),
            upcoming: @json($upcomingAppointments),
            last7: @json($last7Days)
        };
    </script>

    <script src="/js/dashboard-appointments.js"></script>

</x-app-layout>
