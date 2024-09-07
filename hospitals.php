<?php
include 'phpHeader.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATJS - Listed Hospitals</title>
    <link rel="stylesheet" href="loginSignup.css" />
</head>

<body>
    <?php include 'navbar.php'; ?>
    <main>
        <div>
            No Hospital Found
            include 'phpHeader.php';

            $sql = "SELECT HospitalID, HospitalName FROM Hospitals";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Extracting the first letter of hospital name for display
                    $first_letter = strtoupper(substr($row['HospitalName'], 0, 1));
                    echo '<div class="card">';
                    echo '    <div class="card-header">';
                    echo '        <div class="dp">' . $first_letter . '</div>';
                    echo '        <div class="name">' . htmlspecialchars($row['HospitalName']) . '</div>';
                    echo '    </div>';
                    echo '    <div class="flex">';
                    echo '    <button onclick="viewLocation()">View Location</button>';
                    echo '    <button onclick="viewDoctors(' . $row['HospitalID'] . ')">View Doctors</button>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hospitals found</p>';
            }

            $conn->close();
            ?>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>