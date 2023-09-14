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

// Assuming you have a unique identifier (e.g., resume ID) for the resume you want to display
$resumeId = 1; // Change this to the appropriate resume ID

// Retrieve resume data from the database based on the resume ID
$sql = "SELECT * FROM resumes WHERE id = $resumeId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the selected resume
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $email = $row["email"];
    $summary = $row["summary"];
    $experience = $row["experience"];

    // Generate HTML for the resume
    $html = "<p><strong>Name:</strong> $name</p>";
    $html .= "<p><strong>Email:</strong> $email</p>";
    $html .= "<p><strong>Summary:</strong><br>$summary</p>";
    $html .= "<p><strong>Experience:</strong><br>$experience</p>";

    // Output the HTML content
    echo $html;
} else {
    echo "No resume data found for the specified resume ID.";
}

$conn->close();
?>
