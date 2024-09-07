<?php
// book_appointment.php
include 'phpHeader.php'; // Ensure this file contains the database connection code
session_start();

if (!isset($_GET['doctor_id'])) {
    die("Doctor ID is required");
}

$doctor_id = $_GET['doctor_id'];

// Fetch doctor details from the database
$sql = "SELECT DoctorID, FirstName FROM doctor WHERE DoctorID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();

$doctor = $result->fetch_assoc();
if (!$doctor) {
    die("Doctor not found");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATJS - Book Appointment</title>
    <!-- link css  -->
    <link rel="stylesheet" href="LoginSignup.css" />
</head>

<body>
    <!-- navbar  -->
    <?php include 'navbar.php'; ?>

    <main>
        <div class="img">
            <img src="./resources/pngwing.com.png" alt="Doctor Image">
        </div>
        <div class="formContainer doctorForm">
            <form class="form" action="appointmentFormBackend.php" method="post">
                <p class="title">Book Appointment with Dr. <?php echo htmlspecialchars($doctor['FirstName']); ?></p>

                <div class="sectionWrapper">
                    <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor['DoctorID']); ?>">
                    <div class="flex">
                        <label>
                            <input required type="date" id="appointment_date" name="appointment_date" class="input"
                                placeholder="Date">
                        </label>
                        <label>
                            <input required type="time" id="appointment_time" name="appointment_time" class="input"
                                placeholder="Time">
                        </label>
                    </div>
                    <label>
                        <input required type="text" id="patient_name" name="patient_name" class="input"
                            placeholder="Your Name">
                    </label>
                    <label>
                        <input required type="text" id="patient_contact" name="patient_contact" class="input"
                            placeholder="Contact Info">
                    </label>
                </div>

                <button class="button-submit">Book Appointment</button>
            </form>
        </div>
    </main>

    <!-- footer  -->
    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>