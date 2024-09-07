<?php
// Database connection
include 'phpHeader.php';
session_start();

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM doctor WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Doctor exists, check password
        $row = $result->fetch_assoc();
        if ($password == $row['Password']) {
            // Password is correct, login successful
            $_SESSION['DoctorID'] = $row['DoctorID'];
            header("Location: doctorDashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid password. Please try again.'); window.location.href = 'doctorLogin.php';</script>";
            exit();
        }
    } else {
        // Doctor does not exist, display error and prompt to sign up
        echo "<script>alert('Login failed. Please sign up.'); window.location.href = 'doctorSignup.php';</script>";
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
