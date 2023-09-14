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

    // Delete the job listing from the database using the jobId
    $query = "DELETE FROM jobs WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $jobId);

    if ($stmt->execute()) {
        // Job listing deleted successfully
        // You can redirect the user back to the job list page or show a success message
    } else {
        echo "Error deleting job listing: " . $stmt->error;
    }
} else {
    echo "JobId not provided.";
}

// Close the database connection
$db->close();
?>
