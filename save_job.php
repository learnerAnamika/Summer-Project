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

// Get data from the form and perform basic validation
$jobTitle = $_POST['jobTitle'];
$jobDetails = $_POST['jobDetails'];
$jobLocation = $_POST['jobLocation'];
$pay = $_POST['pay'];
$jobType = $_POST['jobType'];
$qualification = $_POST['qualification'];
$jobBenefits = $_POST['jobBenefits'];

// Check if required fields are not empty
if (empty($jobTitle) || empty($jobLocation) || empty($pay)) {
    echo "Error: Please fill in all required fields.";
} else {
    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO jobs (jobTitle, jobDetails, jobLocation, pay, jobType, qualification, jobBenefits)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $db->prepare($sql);

    // Bind parameters to the placeholders
    $stmt->bind_param("sssssss", $jobTitle, $jobDetails, $jobLocation, $pay, $jobType, $qualification, $jobBenefits);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: employer.html?job=saved_successfully");
        exit; // Ensure no code is executed after the header redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$db->close();
?>
