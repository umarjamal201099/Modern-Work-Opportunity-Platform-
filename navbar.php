<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Work Opportunity Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Custom CSS styles */
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="logo.jpeg" width="80" height="80" class="d-inline-block align-top" alt="Logo">
        </a>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <form class="form-inline my-2 my-lg-0">
                <div class="input-group">
                    <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" style=" margin-left:150px; width: 800px; height: 60px;">
                    <div class="input-group-append">
                        <button class="btn btn-outline-warning" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link text-dark btn btn-warning" href="login.php">Admin Login</a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Second Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-warning" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="career.php">Career Opportunities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="employer_login.php">Employer Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="job_seeker_login.php">Job Seeker Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="job_seeker_signup.php">Job Seeker Registration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="employer_signup.php">Employer Registration</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>