<?php
// Connect to MySQL database (replace with your credentials)
$servername = "localhost";
$username = "root"
$password = "your_password";
$dbname = "project_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$sender_email = $_POST["sender_email"];
$receiver_email = $_POST["receiver_email"];
$subject = $_POST["subject"];
$message_body = $_POST["message_body"];

// Insert the email into the database
$sql = "INSERT INTO messages (sender_email, receiver_email, subject, message_body) VALUES ('$sender_email', '$receiver_email', '$subject', '$message_body')";

if ($conn->query($sql) === TRUE) {
    echo "Email sent successfully.";
    header("Location: eemail.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
