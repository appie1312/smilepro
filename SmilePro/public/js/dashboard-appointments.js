document.addEventListener("DOMContentLoaded", () => {

    // 🔹 Stat cards vullen
    document.getElementById('totalAppointmentsBox').innerHTML = cardHTML("Totaal afspraken", statsData.total);
    document.getElementById('todayAppointmentsBox').innerHTML = cardHTML("Afspraken vandaag", statsData.today);
    document.getElementById('upcomingAppointmentsBox').innerHTML = cardHTML("Komende afspraken", statsData.upcoming);

    // 🔹 Laatste 7 dagen renderen
    const container = document.getElementById('last7DaysContainer');
    if (statsData.last7.length === 0) {
        container.innerHTML = `<p class="text-gray-500 text-sm col-span-7">Geen afspraken gevonden.</p>`;
        return;
    }

    statsData.last7.forEach(day => {
        container.innerHTML += `
            <div class="text-center">
                <div class="text-xs text-gray-500">${formatDate(day.day)}</div>
                <div class="mt-1 text-xl font-semibold">${day.total}</div>
            </div>
        `;
    });
});

function cardHTML(title, value) {
    return `
        <p class="text-sm opacity-80">${title}</p>
        <p class="mt-2 text-3xl font-bold">${value}</p>
    `;
}

function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString("nl-NL", { day: "2-digit", month: "2-digit" });
}
