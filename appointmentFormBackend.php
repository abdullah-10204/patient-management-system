<?php
// process_appointment.php
include 'phpHeader.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $patient_name = $_POST['patient_name'];
    $patient_contact = $_POST['patient_contact'];

    // Perform input validation as necessary
    // ...

    // Save appointment to the database
    $sql = "INSERT INTO appointments (doctor_id, appointment_date, appointment_time, patient_name, patient_contact) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $doctor_id, $appointment_date, $appointment_time, $patient_name, $patient_contact);

    if ($stmt->execute()) {
        header("Location: afterAppointment.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle invalid access
    die("Invalid request");
}
?>
