<?php
// Connect to the database
$conn = new mysqli("localhost", "username", "password", "your_database");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $applicant_name = $_POST["applicant_name"];
    $interview_date = $_POST["interview_date"];
    $interview_location = $_POST["interview_location"];
    // Add more fields as needed
    
    // Insert data into the interviews table
    $sql = "INSERT INTO interviews (applicant_name, interview_date, interview_location) VALUES ('$applicant_name', '$interview_date', '$interview_location')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Interview scheduled successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
