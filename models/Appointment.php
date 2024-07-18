<?php
include_once '../config/database.php';

class Appointment {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($patient_name, $doctor_id, $appointment_date, $status) {
        $query = "INSERT INTO appointments (patient_name, doctor_id, appointment_date, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("siss", $patient_name, $doctor_id, $appointment_date, $status);
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT * FROM appointments";
        $result = $this->conn->query($query);
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        return $appointments;
    }

    public function delete($id) {
        $query = "DELETE FROM appointments WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
