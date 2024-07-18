<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../controllers/AppointmentController.php';

$controller = new AppointmentController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_name = $_POST['patient_name'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $status = $_POST['status'];

    echo $controller->createAppointment($patient_name, $doctor_id, $appointment_date, $status);
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo $controller->getAppointments();
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'];
    echo $controller->deleteAppointment($id);
}
?>
