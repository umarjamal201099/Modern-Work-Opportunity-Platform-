<?php
// Start a session
session_start();

include 'navbar.php';
include 'dbconn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $company_email = $_POST['company_email'];
    $password = $_POST['password'];

    // Check if email exists in the database
    $check_query = "SELECT * FROM employer_data WHERE company_email='$company_email'";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Check status
            if ($row['status'] == 'pending') {
                echo "<script>alert('Your approval status is pending. Please wait for approval.');</script>";
            } elseif ($row['status'] == 'approved') {
                // Password is correct and status is approved, set session and redirect to dashboard
                $_SESSION['id'] = $row['id']; // Set the session variable
                header("Location: employers/profile.php");
                exit();
            } elseif ($row['status'] == 'rejected') {
                echo "<script>alert('Your status is rejected. Please contact the administrator for more information.');</script>";
            }
        } else {
            echo "<script>alert('Incorrect password');</script>";
        }
    } else {
        echo "<script>alert('Email not found');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Login</title>
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
            margin-top: 50px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Employer login form -->
    <div class="container text-warning">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-container">
                    <h3 class="text-center">Employer Login </h3>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label for="company_email">Company Email:</label>
                            <input type="email" class="form-control" id="company_email" name="company_email" required placeholder="Enter your company email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-block">Login</button>
                        </div>
                        <div class="form-group text-center">
                            <a href="employer_forgot_password.php">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>