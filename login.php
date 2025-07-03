<?php
session_start();
require 'db.php';

$username = trim($_POST['username']);
$password = $_POST['password'];

// Find user by username or email
$query = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$query->bind_param("ss", $username, $username);
$query->execute();
$result = $query->get_result();

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify hashed password
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email']; // ✅ Needed for auto-fill

        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php?showLogin=1&msg=wrongpass");
        exit();
    }
} else {
    header("Location: index.php?showLogin=1&msg=notfound");
    exit();
}
?>
