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

// Fetch job listings from the database
$sql = "SELECT jobTitle, jobDetails, jobLocation, pay, jobType, qualification, jobBenefits FROM jobs";
$result = $db->query($sql);

$jobList = array();

if ($result->num_rows > 0) {
    // Add each job as an associative array to the $jobList array
    while ($row = $result->fetch_assoc()) {
        $jobList[] = $row;
    }
}

// Close the database connection
$db->close();

// Convert the job list to JSON and echo it
echo json_encode($jobList);
?>
