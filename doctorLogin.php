<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATJS - Login</title>

    <!-- link css  -->
    <link rel="stylesheet" href="loginSignup.css" />
</head>

<body>
    <!-- navbar  -->
    <?php include 'navbar.php'; ?>

    <main>
        <div class="img">
            <img src="./resources/pngwing.com.png" alt="">
        </div>
        <div class="formContainer">
            <form class="form" action="doctorLoginBackend.php" method="POST">
                <p class="title">Login as Doctor</p>

                <label>
                    <input required="" placeholder="Email" type="email" class="input" name="email">
                    <!-- <span>Email</span> -->
                </label>

                <label>
                    <input required="" placeholder="Password" type="password" class="input" name="password">
                    <!-- <span>Password</span> -->
                </label>

                <button class="button-submit">Submit</button>
                <p class="signin">Don't have an acount ? <a href="doctorSignup.php"><b>Sign Up</b></a> </p>
            </form>
        </div>
    </main>

    <!-- footer  -->
    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>