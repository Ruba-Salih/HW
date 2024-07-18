document.addEventListener("DOMContentLoaded", function() {
    fetchAppointments();
});

function fetchAppointments() {
    fetch('../public/index.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#appointments tbody');
            tbody.innerHTML = '';
            data.forEach(appointment => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${appointment.id}</td>
                    <td>${appointment.patient_name}</td>
                    <td>${appointment.doctor_id}</td>
                    <td>${appointment.appointment_date}</td>
                    <td>${appointment.status}</td>
                    <td>
                        <button onclick="updateAppointment(${appointment.id})">Update</button>
                        <button onclick="deleteAppointment(${appointment.id})">Delete</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        });
}

function updateAppointment(id) {
    // Implement update functionality
}

function deleteAppointment(id) {
    fetch(`../public/index.php?id=${id}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        fetchAppointments();
    });
}
