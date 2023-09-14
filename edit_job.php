<?php
// Database connection parameters
$servername = "localhost";    //  database host
$dbname = "project_db";       //  database name
$username = "root";           //  database username
$password = "";               //  database password

// Create a database connection
$db = new mysqli($servername, $username, $password, $dbname);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if (isset($_GET['jobId'])) {
    $jobId = $_GET['jobId'];

    // Retrieve the job data from the database using the jobId
    $query = "SELECT * FROM jobs WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $jobId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $job = $result->fetch_assoc();
        // Display an edit form with job data pre-filled
        // Include form fields for editing job details
    } else {
        echo "Job not found.";
    }
} else {
    echo "JobId not provided.";
}

// Close the database connection
$db->close();
?>
