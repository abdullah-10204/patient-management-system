<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile Form</title>

    <!-- link css  -->
    <link rel="stylesheet" href="LoginSignup.css" />
</head>

<body>
    <!-- navbar  -->
    <?php include 'navbar.php'; ?>

    <main class="main">
        <div class="img">
            <img src="./resources/pngwing.com.png" alt="">
        </div>
        <div class="formContainer doctorForm">
            <form class="form" action="doctorSignupBackend.php" method="POST">
                <p class="title">Register as Doctor</p>
                <p class="smallHeading">Personal Info</p>
                <div class="sectionWrapper">
                    <div>
                        <div class="leftSection">
                            <div class="flex">
                                <label>
                                    <input required placeholder="Firstname" type="text" class="input" name="firstName">
                                </label>

                                <label>
                                    <input required placeholder="Lastname" type="text" class="input" name="lastName">
                                </label>
                            </div>
                            <label>
                                <input required placeholder="Email" type="email" class="input" name="email">
                            </label>

                            <label>
                                <input required placeholder="Phone no." type="tel" class="input" name="phoneNo">
                            </label>
                        </div>

                        <div class="rightSection">
                            <div class="flex">
                                <label>
                                    <input required placeholder="City" type="text" class="input" name="city">
                                </label>

                                <label for="gender">
                                    <select name="gender" id="gender" placeholder="Select gender">
                                        <option value="" disabled selected>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </label>
                            </div>
                            <label>
                                <input required placeholder="Password" type="password" class="input" name="password">
                            </label>
                            <label>
                                <input required placeholder="Confirm password" type="password" class="input"
                                    name="confirmPassword">
                            </label>
                        </div>
                    </div>
                    <label>
                        <input required placeholder="Clinic Address" type="text" class="input" name="address">
                    </label>
                </div>


                <p class="smallHeading">Professional Info</p>
                <div class="sectionWrapper">
                    <div class="rightSection">
                        <div class="flex">
                            <label>
                                <input required placeholder="Years of Experience" type="number" class="input"
                                    name="experience">
                            </label>

                            <!-- Display Departments -->
                            <label for="department">
                                <select name="department" id="department">
                                    <option value="" disabled selected>Department</option>
                                    <?php
                                    include 'phpHeader.php';
                                    // Fetch departments from the database
                                    $queryDepartments = "SELECT * FROM departments";
                                    $resultDepartments = mysqli_query($conn, $queryDepartments);
                                    while ($row = mysqli_fetch_assoc($resultDepartments)) {
                                        echo "<option value='" . $row['DeptID'] . "'>" . $row['DeptName'] . "</option>";
                                        // echo "<option value='". $row['DeptName'] . "'</option>";
                                    }
                                    ?>
                                </select>
                            </label>

                        </div>
                        <label for="hospital">
                            <select name="hospital" id="hospital">
                                <option value="" disabled selected>Hospital</option>
                                <?php
                                include 'phpHeader.php';
                                // Fetch hospitals from the database
                                $queryHospitals = "SELECT * FROM hospitals";
                                $resultHospitals = mysqli_query($conn, $queryHospitals);
                                while ($row = mysqli_fetch_assoc($resultHospitals)) {
                                    echo "<option value='" . $row['HospitalID'] . "'>" . $row['HospitalName'] . "</option>";
                                }
                                ?>
                            </select>
                        </label>
                    </div>

                    <div class="leftSection">
                        <div class="flex">
                            <label>
                                <input required placeholder="Availability Starting" type="text" class="input"
                                    name="startingTime" onfocus="(this.type='time')">
                            </label>

                            <label>
                                <input required placeholder="Availability Ending" type="text" class="input"
                                    name="EndingTime" onfocus="(this.type='time')">
                            </label>
                        </div>
                        <label>
                            <input required placeholder="Fee per Appointment" type="text" class="input" name="fee">
                        </label>
                    </div>
                </div>

                <button class="button-submit">Submit</button>
                <p class="signin">Already have an account? <a href="doctorLogin.php"><b>Sign In</b></a></p>
            </form>
        </div>
    </main>

    <!-- footer  -->
    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>