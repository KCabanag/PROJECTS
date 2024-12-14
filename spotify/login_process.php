<?php
// Start the session
session_start();

// Include the database connection
include('db.php'); // Make sure this file contains the correct database connection details

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the user input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate the input fields
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Please enter both username and password.';
        header('Location: login.php');
        exit();
    }

    // Prepare SQL statement to fetch user data
    $sql = "SELECT * FROM users WHERE username = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind the username to the prepared statement
        $stmt->bind_param('s', $username);
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();

        // Check if the username exists
        if ($result->num_rows == 1) {
            // Fetch the user data
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password is correct, set session variables and redirect to the dashboard
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                
                header('Location: dashboard.php'); // Redirect to the dashboard (change to your actual page)
            } else {
                // Incorrect password
                $_SESSION['error'] = 'Incorrect password. Please try again.';
                header('Location: login.php');
            }
        } else {
            // Username does not exist
            $_SESSION['error'] = 'Username not found. Please check and try again.';
            header('Location: login.php');
        }

        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['error'] = 'Error processing your request. Please try again later.';
        
    }
}