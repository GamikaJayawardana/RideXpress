<?php
require 'db.php';

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if username or email already exists
$check = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$check->bind_param("ss", $username, $email);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    header("Location: index.php?showSignup=1&msg=exists");
    exit();
}

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashedPassword);

if ($stmt->execute()) {
    header("Location: index.php?showLogin=1&msg=registered");
    exit();
} else {
    header("Location: index.php?showSignup=1&msg=error");
    exit();
}
?>
