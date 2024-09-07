<?php
// viewDoctors.php
include 'phpHeader.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors in Hospital</title>
    <link rel="stylesheet" href="loginSignup.css" />
    <style>
        main {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            height: max-content;
            gap: 2rem;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            width: 100%;
            /* justify-content: center; */
        }

        .card {
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            width: calc(33% - 2rem);
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .card .dp {
            background-color: var(--main-color);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            margin-right: 1rem;
        }

        .card .name {
            font-size: 1.4rem;
            font-weight: bold;
            color: #333;
        }

        .card .details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .card .details div {
            font-size: 0.9rem;
            color: #555;
        }

        .card a {
            background-color: var(--main-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            margin-top: 1rem;
            transition: background-color 0.3s;
        }

        .card a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <main>
        <div class="card-container">
            <?php
            if (isset($_GET['hospital_id'])) {
                $hospital_id = $_GET['hospital_id'];

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT doctor.*, Departments.DeptName 
                        FROM doctor 
                        INNER JOIN Departments ON doctor.DepartmentID = Departments.DeptID 
                        WHERE HospitalID = " . $conn->real_escape_string($hospital_id);

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card">';
                        echo '    <div class="card-header">';
                        echo '        <div class="dp">' . htmlspecialchars($row['FirstName'][0]) . '</div>';
                        echo '        <div class="name">' . htmlspecialchars($row['FirstName'] . ' ' . $row['LastName']) . '</div>';
                        echo '    </div>';
                        echo '    <div class="details">';
                        echo '        <div><strong>Email:</strong> ' . htmlspecialchars($row['Email']) . '</div>';
                        echo '        <div><strong>Phone No:</strong> ' . htmlspecialchars($row['PhoneNo']) . '</div>';
                        echo '        <div><strong>City:</strong> ' . htmlspecialchars($row['City']) . '</div>';
                        echo '        <div><strong>Gender:</strong> ' . htmlspecialchars($row['Gender']) . '</div>';
                        echo '        <div><strong>Address:</strong> ' . htmlspecialchars($row['Address']) . '</div>';
                        echo '        <div><strong>Experience:</strong> ' . htmlspecialchars($row['Experience']) . ' years</div>';
                        echo '        <div><strong>Department:</strong> ' . htmlspecialchars($row['DeptName']) . '</div>';
                        echo '        <div><strong>Working Hours:</strong> ' . htmlspecialchars($row['StartingTime']) . ' - ' . htmlspecialchars($row['EndingTime']) . '</div>';
                        echo '        <div><strong>Fee:</strong> $' . htmlspecialchars($row['Fee']) . '</div>';
                        echo '    </div>';
                        echo '    <a href="appointmentForm.php?doctor_id=' . urlencode($row['DoctorID']) . '">Book Appointment</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No doctors found in this hospital</p>';
                }

                $conn->close();
            } else {
                echo '<p>Invalid hospital ID</p>';
            }
            ?>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>
