<?php
// Database connection
include 'phpHeader.php';

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM userlogininfo WHERE email='$email'";
    // $sql = "DELETE FROM userlogininfo WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, check password
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            // Password is correct, login successful
            $_SESSION['userId']=$row['userId'];
            header("Location: viewAllDoctors.php");
            exit();
        } else {
            // Wrong password
            echo "<script>alert('Invalid password. Please try again.'); window.location.href = 'userLogin.php';</script>";
            exit();
        }
    } else {
        // User does not exist, display error and prompt to sign up
        echo "<script>alert('Login failed. Please sign up'); window.location.href = 'userSignup.php';</script>";
        exit();
    }
}

$conn->close();
?>

