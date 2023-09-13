<?php
// Connect to the database
$conn = new mysqli("65.109.153.186", "shrishak_nc", "Aditya@123", "shrishak_nc");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $job_title = $_POST["job_title"];
    $company = $_POST["company"];
    $job_description = $_POST["job_description"];
    $location = $_POST["location"];
    // Add more fields as needed
    
    // Insert data into the jobs table
    $sql = "INSERT INTO jobs (job_title, company, job_description, location) VALUES ('$job_title', '$company', '$job_description', '$location')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Job posted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
