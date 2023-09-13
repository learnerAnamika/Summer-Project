<?php
// Database connection parameters
$servername = "65.109.153.186";        // Replace with your database host
$dbname = "shrishak_nc";     // Replace with your database name
$username = "shrishak_nc";         // Replace with your database username
$password = "Aditya@123";             // Replace with your database password

// Create a database connection
$db = new mysqli($servername, $username, $password, $dbname);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Get data from the form
$jobTitle = $_POST['jobTitle'];
$jobDetails = $_POST['jobDetails'];
$jobLocation = $_POST['jobLocation'];
$pay = $_POST['pay'];
$jobType = $_POST['jobType'];
$qualification = $_POST['qualification'];
$jobBenefits = $_POST['jobBenefits'];

// Insert the job into the database
$sql = "INSERT INTO jobs (jobTitle, jobDetails, jobLocation, pay, jobType, qualification, jobBenefits)
        VALUES ('$jobTitle', '$jobDetails', '$jobLocation', '$pay', '$jobType', '$qualification', '$jobBenefits')";

if ($db->query($sql) === TRUE) {
    header("Location: joblistings.html?job saved successfully");
    
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

// Close the database connection
$db->close();
?>
