document.addEventListener("DOMContentLoaded", () => {
    const table = document.getElementById('appointmentsTable');
    if (!table || !Array.isArray(appointments)) return;

    appointments.forEach(app => {
        try {
            let row = document.createElement("tr");
            row.classList.add("hover:bg-gray-50");

            row.innerHTML = `
                <td class="border px-4 py-2">${app.customer_name}</td>
                <td class="border px-4 py-2">${formatDate(app.appointment_date)}</td>
                <td class="border px-4 py-2">${formatTime(app.appointment_time)}</td>
                <td class="border px-4 py-2">${app.phone}</td>
                <td class="border px-4 py-2">${app.address}</td>
            `;

            table.appendChild(row);
        } catch (error) {
            console.error("Fout bij verwerken afspraak:", app, error);
        }
    });
});

function formatDate(dateString){
    try {
        return new Date(dateString).toLocaleDateString("nl-NL");
    } catch {
        return "Ongeldige datum";
    }
}

function formatTime(timeString){
    try {
        return timeString.substring(0, 5);
    } catch {
        return "Onbekend";
    }
}
