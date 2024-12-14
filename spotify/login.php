<?php
// Start the session to show error/success messages
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Spotify Data Analytics Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: white;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
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

    <!-- Login Container -->
    <div class="login-container">
        <div class="header-title">
            <i class="fas fa-sign-in-alt"></i> <span>Login to Your Account</span>
        </div>

        <!-- Display Error or Success Messages -->
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <!-- Login Form -->
        <form action="login_process.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <!-- Sign Up Link -->
        <div class="text-center mt-3">
            <p>Don't have an account? <a href="sign_up.php" class="signup-link">Sign Up here</a></p>
        </div>
    </div>

    <div class="footer-text">
        <p>&copy; 2024 Spotify Data Analytics. All Rights Reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
