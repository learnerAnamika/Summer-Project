<?php
// Connect to MySQL database (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "your_password";
$dbname = "project_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve received emails
$sql = "SELECT * FROM messages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>Subject:</strong> " . $row["subject"] . "</p>";
        echo "<p><strong>From:</strong> " . $row["sender_email"] . "</p>";
        echo "<p><strong>Message:</strong> " . $row["message_body"] . "</p>";
        echo "<hr>";
    }
} else {
    echo "No emails received.";
}

$conn->close();
?>
