<?php
include 'navbar.php';
include 'header.php';
include 'dbconn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $company_name = $_POST['company_name'];
    $company_email = $_POST['company_email'];
    $mission = $_POST['mission'];
    $value = $_POST['value'];
    $job_titles = $_POST['job_title'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $check_query = "SELECT * FROM employer_data WHERE company_email=?";
        $check_stmt = mysqli_prepare($conn, $check_query);
        mysqli_stmt_bind_param($check_stmt, "s", $company_email);
        mysqli_stmt_execute($check_stmt);
        $result = mysqli_stmt_get_result($check_stmt);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email already exists');</script>";
        } else {
            // Concatenate job titles
            $job_titles_str = implode(',', $job_titles);

            // Insert data into employer_data table using prepared statement
            $insert_query = "INSERT INTO employer_data (company_name, company_email, mission, value, job_title, password) VALUES (?, ?, ?, ?, ?, ?)";
            $insert_stmt = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($insert_stmt, "ssssss", $company_name, $company_email, $mission, $value, $job_titles_str, $hashed_password);

            if (mysqli_stmt_execute($insert_stmt)) {
                echo "<script>alert('Data inserted successfully');</script>";
            } else {
                echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS styles */
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 800px;
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
    <!-- Employer sign-up form -->
    <div class="container text-warning">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-container">
                    <h3 class="text-center">Employer Sign Up</h3>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="company_name">Company Name:</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" required placeholder="Enter your company name">
                            </div>

                            <div class="form-group col-6">
                                <label for="company_email">Company Email:</label>
                                <input type="email" class="form-control" id="company_email" name="company_email" required placeholder="Enter your company email">
                            </div>

                            <div class="form-group col-6">
                                <label for="mission">Mission:</label>
                                <textarea class="form-control" id="mission" name="mission" required rows="2" placeholder="Enter your company's mission"></textarea>
                            </div>

                            <div class="form-group col-6">
                                <label for="value">Value:</label>
                                <textarea class="form-control" id="value" name="value" required rows="2" placeholder="Enter your company's value"></textarea>
                            </div>

                            <div class="form-group col-6">
                                <label for="job_title">Job Title:</label>
                                <input type="text" class="form-control" id="job_title" name="job_title[]" required placeholder="Enter job title">
                            </div>

                            <div class="form-group col-6">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                            </div>

                            <div class="form-group col-6">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="Confirm your password">
                            </div>

                            <div class="form-group col-6">
                                <button type="button" class="btn btn-dark " id="add_job">Add More Job</button>&nbsp;
                            </div>
                            <div class="form-group col-6">
                                <button type="submit" class="btn btn-dark ">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <?php
        include 'footer.php';
        ?>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var jobIndex = 1;

            $("#add_job").click(function() {
                jobIndex++;
                var jobField = '<div class="form-group">' +
                    '<label for="job_title_' + jobIndex + '">Job Title:</label>' +
                    '<input type="text" class="form-control" id="job_title_' + jobIndex + '" name="job_title[]" required>' +
                    '</div>';
                $(this).before(jobField);
            });
        });
    </script>
</body>

</html>