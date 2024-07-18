<?php
include_once '../config/database.php';
include_once '../models/Appointment.php';

class AppointmentController {
    private $db;
    private $appointment;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->appointment = new Appointment($this->db);
    }

    public function createAppointment($patient_name, $doctor_id, $appointment_date, $status) {
        $this->appointment->patient_name = $patient_name;
        $this->appointment->doctor_id = $doctor_id;
        $this->appointment->appointment_date = $appointment_date;
        $this->appointment->status = $status;

        if ($this->appointment->create()) {
            return json_encode(array("message" => "Appointment was created."));
        } else {
            return json_encode(array("message" => "Unable to create appointment."));
        }
    }

    public function getAppointments() {
        $stmt = $this->appointment->read();
        $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($appointments);
    }

    public function updateAppointment($id, $patient_name, $doctor_id, $appointment_date, $status) {
        $this->appointment->id = $id;
        $this->appointment->patient_name = $patient_name;
        $this->appointment->doctor_id = $doctor_id;
        $this->appointment->appointment_date = $appointment_date;
        $this->appointment->status = $status;

        if ($this->appointment->update()) {
            return json_encode(array("message" => "Appointment was updated."));
        } else {
            return json_encode(array("message" => "Unable to update appointment."));
        }
    }

    public function deleteAppointment($id) {
        $this->appointment->id = $id;

        if ($this->appointment->delete()) {
            return json_encode(array("message" => "Appointment was deleted."));
        } else {
            return json_encode(array("message" => "Unable to delete appointment."));
        }
    }
}
?>
