<?php
// Connect to MySQL database (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have a user identifier (e.g., user ID or email) for fetching the specific user's resume
$userEmail = "user_email@example.com"; // Replace with the actual user's email

// Retrieve the user's resume data from the database
$sql = "SELECT * FROM resumes WHERE email='$userEmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Create a text content for the resume
    $resumeContent = "Name: " . $row["name"] . "\n";
    $resumeContent .= "Email: " . $row["email"] . "\n";
    $resumeContent .= "Summary: " . $row["summary"] . "\n";
    $resumeContent .= "Experience: " . $row["experience"];

    // Set the appropriate content type and headers for download
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="my_resume.txt"');

    // Output the resume content for download
    echo $resumeContent;
} else {
    echo "No resume found.";
}

$conn->close();
?>
