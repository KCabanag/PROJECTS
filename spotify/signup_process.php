<?php
// Start the session to store messages
session_start();

// Include database connection
include('db.php'); // Ensure db.php contains the correct connection settings

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the user inputs
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate input data
    if (empty($full_name) || empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = 'Please fill in all fields.';
        header('Location: signup.php');
        exit();
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: signup.php');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement to insert the user data
    $sql = "INSERT INTO users (full_name, email, username, password) VALUES (?, ?, ?, ?)";

    // Use prepared statements to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('ssss', $full_name, $email, $username, $hashed_password);
        
        // Execute the statement and check if the user was successfully added
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Account created successfully. You can now log in.';
            header('Location: login.php'); // Redirect to login page
        } else {
            $_SESSION['error'] = 'Error creating account. Please try again later.';
            header('Location: signup.php');
        }

        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['error'] = 'Error preparing the database query.';
        header('Location: signup.php');
    }

    // Close the database connection
    $conn->close();
}
?>
