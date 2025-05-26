<?php
session_start();
if (!isset($_SESSION['name'], $_SESSION['email'], $_SESSION['password'])) {
    header("Location: registration.php");
    exit();
}

include __DIR__. '/includes/db.php';

$name = $_SESSION['name'];
$email = $_SESSION['email'];
$password = password_hash($_SESSION['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    header("Location: success.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
