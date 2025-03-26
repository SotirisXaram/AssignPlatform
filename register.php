<?php
session_start();
require 'config.php';

$username = isset($_POST["username"]) ? trim($_POST["username"]) : null;
$password = isset($_POST["password"]) ? trim($_POST["password"]) : null;
$email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
$role = isset($_POST["role"]) ? trim($_POST["role"]) : null; 


if (empty($username) || empty($password) || empty($email) || empty($role)) {
    echo '<script>alert("All fields are required!"); window.location="register.html";</script>';
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("Invalid email format!"); window.location="register.html";</script>';
    exit();
}

$valid_roles = ["student", "professor"];
if (!in_array($role, $valid_roles)) {
    echo '<script>alert("Invalid role selected!"); window.location="register.html";</script>';
    exit();
}

if (strlen($password) < 10 || 
    !preg_match('/[A-Z]/', $password) || 
    !preg_match('/[a-z]/', $password) || 
    !preg_match('/[0-9]/', $password) || 
    !preg_match('/[!@#$%^&*_-]/', $password)) {
    
    echo '<script>alert("Ο κωδικός πρέπει να είναι τουλάχιστον 10 χαρακτήρες και να περιέχει: 
    ένα κεφαλαίο γράμμα, ένα πεζό γράμμα, έναν αριθμό και έναν ειδικό χαρακτήρα [ !@#$%^&*_- ]");
    window.location="register.html";</script>';
    exit();
}


// Check if username or email already exists
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<script>alert("Username or Email already exists!"); window.location="register.html";</script>';
    exit();
}
$stmt->close();

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $hashed_password, $email, $role);

if ($stmt->execute()) {

    $user_id = $stmt->insert_id;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role; 
    header("Location: index.php");
    exit();
} else {
    echo '<script>alert("Error during registration! Please try again."); window.location="register.html";</script>';
}

$stmt->close();
?>
