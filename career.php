<?php
include 'navbar.php';
include 'dbconn.php';
?>

<style>
    .card {
        width: 30%;
        margin: 0 15px 15px 0;
        float: left;
    }

    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
</style>

<?php
// Fetch all companies' data from the database
$query = "SELECT company_name, company_email, mission, value, job_title FROM employer_data";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "
    <div class='container mt-5'>
        <div class='row'>";

    while ($row = mysqli_fetch_assoc($result)) {
        $company_name = $row['company_name'];
        $company_email = $row['company_email'];
        $mission = $row['mission'];
        $value = $row['value'];
        $job_title = $row['job_title'];

        echo "
        <div class='card mb-5'>
            <div class='card-body'>
                <h5 class='card-title'><strong>Company Name:</strong> $company_name</h5>
                <h6 class='card-subtitle mb-2 text-muted'><strong>Vacant Position:</strong> $job_title</h6>
                <p class='card-text'><strong>Email:</strong> $company_email</p>
                <p class='card-text'><strong>Mission:</strong> $mission</p>
                <p class='card-text'><strong>Value:</strong> $value</p>
            </div>
        </div>";
    }

    echo "
        </div>
    </div>";
} else {
    echo "No companies found.";
}

mysqli_close($conn);

include 'footer.php';
?>