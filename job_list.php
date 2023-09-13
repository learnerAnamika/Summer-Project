<?php
// Include your database connection code here
$servername = "65.109.153.186";
$username = "shrishak_nc";
$password = "Aditya@123";
$dbname = "shrishak_nc";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to store form data
$jobTitle = $jobDescription = $jobLocation = $jobType = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $jobTitle = htmlspecialchars($_POST["jobTitle"]);
    $jobDescription = htmlspecialchars($_POST["jobDescription"]);
    $jobLocation = htmlspecialchars($_POST["jobLocation"]);
    $jobType = htmlspecialchars($_POST["jobType"]);

    // Check for empty fields
    if (empty($jobTitle) || empty($jobDescription) || empty($jobLocation) || empty($jobType)) {
        $errors[] = "All fields are required.";
    }

    // If there are no errors, insert the job listing into the database
    if (empty($errors)) {
        $sql = "INSERT INTO job_listings (job_title, job_description, job_location, job_type) 
                VALUES ('$jobTitle', '$jobDescription', '$jobLocation', '$jobType')";

        if ($conn->query($sql) === true) {
            // Job listing added successfully
            header("Location: employer.html");
        } else {
            $errors[] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Job Listing</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Create Job Listing</h1>
        <?php
        if (!empty($errors)) {
            echo '<div class="alert alert-danger" role="alert">';
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
            echo '</div>';
        }
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="jobTitle">Job Title</label>
                <input type="text" class="form-control" id="jobTitle" name="jobTitle">
            </div>
            <div class="form-group">
                <label for="jobDescription">Job Description</label>
                <textarea class="form-control" id="jobDescription" name="jobDescription" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="jobLocation">Job Location</label>
                <input type="text" class="form-control" id="jobLocation" name="jobLocation">
            </div>
            <div class="form-group">
                <label for="jobType">Job Type</label>
                <select class="form-control" id="jobType" name="jobType">
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Contract">Contract</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Job Listing</button>
        </form>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>





