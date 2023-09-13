<?php
// Connect to the database
$conn = new mysqli("65.109.153.186", "shrishak_nc", "Aditya@123", "shrishak_nc");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $employer_name = $_POST["employer_name"];
    $industry = $_POST["industry"];
    $contact_email = $_POST["contact_email"];
    $phone_number = $_POST["phone_number"];
    // Add more fields as needed
    
    // Insert data into the employers table
    $sql = "INSERT INTO employers (employer_name, industry, contact_email, phone_number) VALUES ('$employer_name', '$industry', '$contact_email', '$phone_number')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Employer profile created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
