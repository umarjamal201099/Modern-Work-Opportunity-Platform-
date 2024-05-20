<?php
include 'navbar.php';
include 'header.php';
include 'dbconn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $dob = $_POST['dob'];
    $cnic = $_POST['cnic'];
    $address = $_POST['address'];
    $skills = implode(", ", $_POST['skills']);
    $experience = implode(", ", $_POST['experience']);
    $education = implode(", ", $_POST['education']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $query = "SELECT * FROM job_seeker WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email already exists');</script>";
        } else {
            // Insert data into database
            $insert_query = "INSERT INTO job_seeker (name, email, phone_number, dob, cnic, address, skills, experience, education, password)
                             VALUES ('$name', '$email', '$phone_number', '$dob', '$cnic', '$address', '$skills', '$experience', '$education', '$hashed_password')";
            if (mysqli_query($conn, $insert_query)) {
                echo "<script>alert('Registered successfully');</script>";
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

    <!-- Sign-up form -->
    <div class="container text-warning">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-container">
                    <h3 class="text-center">Job Seeker Registration</h3>
                    <form action="job_seeker_signup.php" method="post">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" required="required">
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email" required="required">
                            </div>
                            <div class="form-group col-6">
                                <label for="phone_number">Phone Number</label>
                                <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number" required="required">
                            </div>
                            <div class="form-group col-6">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" required="required">
                            </div>
                            <div class="form-group col-6">
                                <label for="cnic">CNIC</label>
                                <input type="text" class="form-control" id="cnic" name="cnic" placeholder="Enter Your CNIC Number" required="required">
                            </div>
                            <div class="form-group col-6">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Your Address" required="required">
                            </div>

                            <div class="form-group col-6">
                                <label for="skills">Skills</label>
                                <div id="skills_container">
                                    <input type="text" class="form-control" name="skills[]" placeholder="Enter Your Skills" required="required">
                                </div>
                                <button type="button" class="btn btn-sm btn-primary mt-1" onclick="addInputField('skills_container', 'skills')">Add More Skill</button>
                            </div>

                            <div class="form-group col-6">
                                <label for="experience">Work Experience</label>
                                <div id="experience_container">
                                    <input type="text" class="form-control" name="experience[]" placeholder="Enter Your Experience" required="required">
                                </div>
                                <button type="button" class="btn btn-sm btn-primary mt-1" onclick="addInputField('experience_container', 'experience')">Add More Experience</button>
                            </div>

                            <div class="form-group col-6">
                                <label for="education">Education</label>
                                <div id="education_container">
                                    <input type="text" class="form-control" name="education[]" placeholder="Enter Your Education" required="required">
                                </div>
                                <button type="button" class="btn btn-sm btn-primary mt-1" onclick="addInputField('education_container', 'education')">Add More Education</button>
                            </div>

                            <div class="form-group col-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" required="required">
                            </div>
                            <div class="form-group col-6">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Your Password" required="required">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark text-warning btn-block" name="btn">Sign Up</button>
                    </form>
                    <div class="text-center mt-3">
                        Already Have An Account? <a href="job_seeker_login.php" class="text-dark">Log In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom">
        <?php
        include 'footer.php';
        ?>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function addInputField(containerId, fieldName) {
            var container = document.getElementById(containerId);
            var input = document.createElement("input");
            input.type = "text";
            input.className = "form-control mt-1";
            input.name = fieldName + "[]";
            input.placeholder = "Enter Your " + fieldName.charAt(0).toUpperCase() + fieldName.slice(1);
            input.required = true;
            container.appendChild(input);
        }
    </script>
</body>

</html>