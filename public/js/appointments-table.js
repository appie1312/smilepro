document.addEventListener("DOMContentLoaded", () => {
    const table = document.getElementById('appointmentsTable');
    if (!table || !Array.isArray(appointments)) return;

    appointments.forEach(app => {
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
    });
});

function formatDate(dateString){
    return new Date(dateString).toLocaleDateString("nl-NL");
}

function formatTime(timeString){
    return timeString.substring(0,5); // 14:30:00 -> 14:30
}
