<?php
include 'navbar.php';
include 'header.php';
include 'dbconn.php'; // Include your database connection file

if (isset($_POST["login_btn"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query the database to get the user's hashed password
    $query = "SELECT id, password FROM admin  WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        // Verify the input password with the hashed password
        if (password_verify($password, $hashed_password)) {
            // Start the session and store the user's ID in the session
            $_SESSION['id'] = $row['id'];

            // Redirect to index.php after successful login
            echo '<script>
                window.location.href = "admin/dashboard.php";
                alert("Login successful. Welcome !");
            </script>';
            exit();
        } else {
            // If password is incorrect, show an alert
            echo '<script>alert("Invalid email or password.");</script>';
        }
    } else {
        // If email is not found, show an alert
        echo '<script>alert("Invalid email or password.");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 80px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Sign-up form -->
    <div class="container  text-warning mb-5" style="margin-top: -40px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <h2 class="text-center">Log In</h2>
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="email">Admin Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email" required="required">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required="required">
                        </div>
                        <button type="submit" class="btn btn-dark text-warning btn-block" name="login_btn">Log In</button>
                    </form>
                    <div class="form-group text-center">
                        <a href="admin_forgot_password.php">Forgot Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom">
        <?php include 'footer.php'; ?>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>