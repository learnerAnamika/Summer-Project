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

// Retrieve form data
$name = $_POST["name"];
$email = $_POST["email"];
$summary = $_POST["summary"];
$experience = $_POST["experience"];

// Insert the resume data into the database
$sql = "INSERT INTO resumes (name, email, summary, experience) VALUES ('$name', '$email', '$summary', '$experience')";

if ($conn->query($sql) === TRUE) {
    echo "Resume saved successfully.";
    header("Location: eresume.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
