<?php

require 'config.php';

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = trim($_POST['username']);
    $pass = trim($_POST['password']);

    // Validate input
    if (empty($username) || empty($pass)) {
        echo '<script>alert("Please fill in both username and password!"); window.location="login.html";</script>';
        exit();
    }

    $query = "SELECT user_id, email, username, password, role FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    
    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $user_id = $user_data['user_id'];
        $email = $user_data['email'];
        $db_username = $user_data['username'];
        $hashed_password = $user_data['password'];
        $role = $user_data['role'];

        // Verify password
        if (password_verify($pass, $hashed_password)) {
            // Successful login, start session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $role;

            echo '<script>alert("Successful Login!"); window.location="index.php";</script>';
            exit();
        } else {
            // Wrong password
            echo '<script>alert("Incorrect password!"); window.location="login.html";</script>';
            exit();
        }
    } else {
        // Username does not exist
        echo '<script>alert("Username not found!"); window.location="login.html";</script>';
        exit();
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
