<?php
require 'db.php';

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$subject = trim($_POST['subject']);
$message = trim($_POST['message']);

if ($name && $email && $message) {
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        header("Location: index.php?msg=messagesent");
    } else {
        header("Location: index.php?msg=messagefail");
    }
} else {
    header("Location: index.php?msg=emptyfields");
}
exit;
