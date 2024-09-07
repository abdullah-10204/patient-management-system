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

    <main>
        <div class="img">
            <img src="./resources/pngwing.com.png" alt="">
        </div>
        <div class="formContainer">
            <form class="form" action="userSignupBackend.php" method="POST">
                <p class="title">Register</p>
                <!-- <p class="message">Signup now and get full access to our app. </p> -->
                <div class="flex">
                    <label>
                        <input required placeholder="Firstname" type="text" class="input" name="firstName">
                        <!-- <span>Firstname</span> -->
                    </label>

                    <label>
                        <input required placeholder="Lastname" type="text" class="input" name="lastName">
                        <!-- <span>Lastname</span> -->
                    </label>
                </div>

                <label>
                    <input required placeholder="Email" type="email" class="input" name="email">
                    <!-- <span>Email</span> -->
                </label>

                <label>
                    <input required placeholder="Phone no." type="tel" class="input" name="phoneNo">
                    <!-- <span>Email</span> -->
                </label>

                <label>
                    <input required placeholder="Password" type="password" class="input" name="password">
                    <!-- <span>Password</span> -->
                </label>
                <label>
                    <input required placeholder="Confirm password" type="password" class="input" name="confirmPassword">
                    <!-- <span>Confirm password</span> -->
                </label>
                <button class="button-submit">Submit</button>
                <p class="signin">Already have an acount ? <a href="userLogin.php"><b>Sign In</b></a> </p>
            </form>
        </div>
    </main>

    <!-- footer  -->
    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>