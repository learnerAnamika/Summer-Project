<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'jobId' and 'resume' fields are set in the POST request
    if (isset($_POST['jobId']) && isset($_FILES['resume'])) {
        $jobId = $_POST['jobId'];

        // Get the uploaded resume file details
        $resumeFile = $_FILES['resume'];

        // Check if the file is valid and has no errors
        if ($resumeFile['error'] === UPLOAD_ERR_OK) {
            // Define a directory where you want to save the uploaded resumes
            $uploadDirectory = 'resumes/';

            // Generate a unique filename for the uploaded resume
            $resumeFileName = uniqid() . '_' . $resumeFile['name'];

            // Move the uploaded resume to the specified directory
            $uploadPath = $uploadDirectory . $resumeFileName;
            if (move_uploaded_file($resumeFile['tmp_name'], $uploadPath)) {
                // Application submitted successfully
                // You can now perform any further processing, like saving the file path to a database
                // and sending email notifications, etc.

                $response = array('success' => true);
                echo json_encode($response);
            } else {
                $response = array('success' => false, 'error' => 'Error moving uploaded file.');
                echo json_encode($response);
            }
        } else {
            $response = array('success' => false, 'error' => 'Error uploading file.');
            echo json_encode($response);
        }
    } else {
        $response = array('success' => false, 'error' => 'Missing parameters in the request.');
        echo json_encode($response);
    }
} else {
    $response = array('success' => false, 'error' => 'Invalid request method.');
    echo json_encode($response);
}
?>
