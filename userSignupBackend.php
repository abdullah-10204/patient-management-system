<?php
// Database connection
include 'phpHeader.php';

// Function to validate phone number format
function validatePhoneNumber($phoneNumber) {
    // Regex pattern for phone number (11 digits)
    $pattern = '/^\d{11}$/';
    return preg_match($pattern, $phoneNumber);
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Failed to Sign up. Please try again.'); window.location.href = 'userSignup.php';</script>";
        exit();
    }

    if (!validatePhoneNumber($phoneNo)) {
        echo "<script>alert('Failed to Sign up. Please try again.'); window.location.href = 'userSignup.php';</script>";
        exit();
    }

    // Insert user data into userLoginInfo table
    $sql = "INSERT INTO userlogininfo (firstName, lastName, email, phoneNo, password) 
            VALUES ('$firstName', '$lastName', '$email', '$phoneNo', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: viewAllDoctors.php");
        exit();
    } else {
        echo "<script>alert('Failed to Sign up. Please try again.'); window.location.href = 'userSignup.php';</script>";
        exit();
    }
}

$conn->close();
?>