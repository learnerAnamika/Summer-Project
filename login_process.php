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
$email = $_POST['email'];
$password = $_POST['password'];

// Sanitize user input (to prevent SQL injection)
$email = $conn->real_escape_string($email);

// Retrieve the hashed password from the database
$sql = "SELECT id, name, email, password FROM user WHERE email = '$email'";
$result = $conn->query($sql);

if ($result) { // Check if the query was successful
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify the entered password against the hashed password
        if (password_verify($password, $row['password'])) {
            // Password is correct, redirect to the homepage
            header("Location: homepage.html"); // Correct the header function
            exit(); // Terminate script execution after the redirect
        } else {
            echo "Incorrect password. <a href='login.php'>Go back</a>";
        }
    } else {
        echo "User not found. <a href='login.html'>Go back</a>";
    }
} else {
    echo "Query failed: " . $conn->error;
}

$conn->close();
?>
