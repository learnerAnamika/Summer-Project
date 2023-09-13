<?php
// Establish a database connection (replace these with your actual database credentials)
$servername = "65.109.153.186";
$username = "shrishak_nc";
$password = "Aditya@123";
$dbname = "shrishak_nc";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$user_type = $_POST['user_type']; // Get the user_type from the POST data

// Check if passwords match
if ($password !== $confirm_password) {
    die("Passwords do not match. <a href='signup.html'>Go back</a>");
}

// Hash the password (for security)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user data into the database, including user_type
$sql = "INSERT INTO user (name, email, password, user_type) VALUES ('$name', '$email', '$hashed_password', '$user_type')";

if ($conn->query($sql) === TRUE) {
    // Redirect to login page with a success message
    header("Location: login.html?registration_success=1");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
