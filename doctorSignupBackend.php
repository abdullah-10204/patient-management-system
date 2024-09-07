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
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $experience = $_POST['experience'];
    $departmentID = $_POST['department'];
    $hospitalID = $_POST['hospital'];
    $startingTime = $_POST['startingTime'];
    $endingTime = $_POST['endingTime'];
    $fee = $_POST['fee'];

    // Check if password and confirm password match
    if ($password !== $confirmPassword || !validatePhoneNumber($phoneNo)) {
        echo "<script>alert('Wrong password. Please try again.'); window.location.href = 'doctorSignup.php';</script>";
        header("Location: doctorSignup.php");
        exit();
    }

    // Check if ending time is after starting time
    if ($startingTime >= $endingTime) {
        // Redirect back to signup page with an error message
        // header("Location: doctorSignup.php?error=time");
        echo "<script>alert('Wrong time input. Please try again.'); window.location.href = 'doctorSignup.php';</script>";
        exit();
    }

    // Insert user data into doctor table
    $sql = "INSERT INTO doctor (FirstName, LastName, Email, PhoneNo, Password, City, Gender, Address, Experience, DepartmentID, HospitalID, StartingTime, EndingTime, Fee) 
            VALUES ('$firstName', '$lastName', '$email', '$phoneNo', '$password', '$city', '$gender', '$address', $experience, $departmentID, $hospitalID, '$startingTime', '$endingTime', $fee)";

    if ($conn->query($sql) === TRUE) {
        header("Location: doctorDashboard.php");
        exit();
    } else {
        echo "<script>alert('Signup failed. Please try again.'); window.location.href = 'doctorSignup.php';</script>";
        exit();
    }
}

$conn->close();
?>
