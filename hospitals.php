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
    <style>
        main {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            height: max-content
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            width: 100%;
        }

        .card {
            background-color: #f5f5f5;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            width: calc(50% - 1.1rem);
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .card .dp {
            background-color: var(--main-color);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
        }

        .card .name {
            font-size: 1.5rem;
            font-weight: bold;
            flex-grow: 1;
        }

        .card .details {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .card a,
        .card button {
            background-color: #007BFF;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            align-self: start;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .card a:hover,
        .card button:hover {
            background-color: #0056b3;
        }

        .card button {
            display: block;
            width: 100%;
            margin-top: 1rem;
            background-color: var(--main-color);
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <main>
        <div class="card-container">
            <?php
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
    <script>
        function viewLocation() {
            // Replace with the actual logic to view location
            alert("Viewing location");
        }


        function viewDoctors(hospitalID) {
            window.location.href = 'viewDoctors.php?hospital_id=' + hospitalID;
        }
    </script>
</body>

</html>