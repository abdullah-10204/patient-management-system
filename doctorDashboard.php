<?php
// doctor_dashboard.php
include 'phpHeader.php';
session_start();

// Check if the doctor is logged in
if (!isset($_SESSION['DoctorID'])) {
    die("You must be logged in to view this page.");
}

$doctor_id = $_SESSION['DoctorID'];

// Fetch appointments for the logged-in doctor
$sql = "
    SELECT 
        appointment_date, 
        appointment_time, 
        patient_name, 
        patient_contact 
    FROM 
        appointments 
    WHERE 
        doctor_id = ?
    ORDER BY 
        appointment_date, appointment_time
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>ATJS - Doctor Dashboard</title>
    <!-- link css  -->
    <link rel="stylesheet" href="loginSignup.css" />
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <main style="flex-direction:column">
        <h2>Your Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Patient Name</th>
                    <th>Contact Info</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($appointments)): ?>
                    <tr>
                        <td colspan="4">No appointments found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['patient_name']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['patient_contact']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

    </main>

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>