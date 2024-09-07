<?php
// doctors.php
include 'phpHeader.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATJS - Appoint Doctor Online</title>
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
        }

        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            width: calc(33% - 1.1rem);
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .card .dp {
            background-color: var(--main-color);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }

        .card .name {
            font-size: 1.2rem;
            font-weight: bold;
            flex-grow: 1;
        }

        .card .rating {
            color: gold;
            font-size: 1.2rem;
        }

        .card .details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .card .details div {
            font-size: 0.9rem;
        }

        .card a {
            background-color: var(--main-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            align-self: start;
            margin-top: 0.5rem;
            transition: all 0.2s ease;
            width: 100%;
            text-align: center;
        }

        .card a:hover{
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <main>
        <div class="card-container">
            <?php
            $dept_filter = isset($_GET['dept_filter']) ? $_GET['dept_filter'] : '';
            $city_filter = isset($_GET['city_filter']) ? $_GET['city_filter'] : '';
            $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT doctor.*, Departments.DeptName, Hospitals.HospitalName 
                    FROM doctor 
                    INNER JOIN Departments ON doctor.DepartmentID = Departments.DeptID 
                    INNER JOIN Hospitals ON doctor.HospitalID = Hospitals.HospitalID 
                    WHERE 1=1";

            if ($dept_filter != "") {
                $sql .= " AND Departments.DeptID = " . $conn->real_escape_string($dept_filter);
            }

            if ($city_filter != "") {
                $sql .= " AND City = '" . $conn->real_escape_string($city_filter) . "'";
            }

            if ($search_name != "") {
                $sql .= " AND (FirstName LIKE '%" . $conn->real_escape_string($search_name) . "%' OR LastName LIKE '%" . $conn->real_escape_string($search_name) . "%')";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '    <div>';
                    echo '        <div class="card-header">';
                    echo '            <div class="dp">' . htmlspecialchars($row['FirstName'][0]) . '</div>';
                    echo '            <div class="name">' . htmlspecialchars($row['FirstName'] . ' ' . $row['LastName']) . '</div>';
                    echo '            <div class="rating">★★★★★</div>'; // Placeholder for rating stars
                    echo '        </div>';
                    echo '        <div class="details">';
                    echo '            <div><strong>Email:</strong> ' . htmlspecialchars($row['Email']) . '</div>';
                    echo '            <div><strong>Phone No:</strong> ' . htmlspecialchars($row['PhoneNo']) . '</div>';
                    echo '            <div><strong>City:</strong> ' . htmlspecialchars($row['City']) . '</div>';
                    echo '            <div><strong>Gender:</strong> ' . htmlspecialchars($row['Gender']) . '</div>';
                    echo '            <div><strong>Address:</strong> ' . htmlspecialchars($row['Address']) . '</div>';
                    echo '            <div><strong>Experience:</strong> ' . htmlspecialchars($row['Experience']) . ' years</div>';
                    echo '            <div><strong>Department:</strong> ' . htmlspecialchars($row['DeptName']) . '</div>';
                    echo '            <div><strong>Hospital:</strong> ' . htmlspecialchars($row['HospitalName']) . '</div>';
                    echo '            <div><strong>Working Hours:</strong> ' . htmlspecialchars($row['StartingTime']) . ' - ' . htmlspecialchars($row['EndingTime']) . '</div>';
                    echo '            <div><strong>Fee:</strong> $' . htmlspecialchars($row['Fee']) . '</div>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '    <a href="appointmentForm.php?doctor_id=' . urlencode($row['DoctorID']) . '">Book Appointment</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>No doctors found</p>';
            }

            $conn->close();
            ?>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>

</html>