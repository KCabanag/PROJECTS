<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Spotify Data Analytics Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: white;
            font-family: 'Poppins', sans-serif;
        }

        .signup-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #1c1c1c;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            color: white;
        }

        .form-control {
            background-color: #2c2c2c;
            color: white;
            border: 1px solid #3c3c3c;
        }

        .form-control:focus {
            background-color: #333;
            border-color: #1DB954;
        }

        .btn-primary {
            background-color: #1DB954;
            border-color: #1DB954;
        }

        .btn-primary:hover {
            background-color: #1AA34A;
            border-color: #1AA34A;
        }

        .header-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: white;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: white;
        }

        .signup-link {
            color: #1DB954;
            text-decoration: none;
        }

        .signup-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- Sign Up Container -->
    <div class="signup-container">
        <div class="header-title">
            <i class="fas fa-user-plus"></i> <span>Sign Up for an Account</span>
        </div>

        <!-- Display Error or Success Messages -->
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>

        <!-- Sign Up Form -->
        <form action="signup_process.php" method="POST">
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>

        <div class="text-center mt-3">
            <p>Already have an account? <a href="login.php" class="signup-link">Log in here</a></p>
        </div>
    </div>

    <div class="footer-text">
        <p>&copy; 2024 Spotify Data Analytics. All Rights Reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
