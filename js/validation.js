function validateForm() {
    var patientName = document.getElementById("patient_name").value;
    var doctorId = document.getElementById("doctor_id").value;
    var appointmentDate = document.getElementById("appointment_date").value;
    var status = document.getElementById("status").value;

    if (patientName == "" || doctorId == "" || appointmentDate == "" || status == "") {
        alert("All fields must be filled out");
        return false;
    }

    if (isNaN(doctorId) || doctorId <= 0) {
        alert("Doctor ID must be a positive number");
        return false;
    }

    return true;
}
