CREATE DATABASE clinic;

USE clinic;

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_name VARCHAR(255) NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') NOT NULL
);
