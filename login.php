<?php
session_start();

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=teeninsights", "root", "");

// Get form data
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Find user
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    // Login success
    $_SESSION['username'] = $user['username'];
    header("Location: news.html"); // redirect to news page
    exit;
} else {
    echo "Invalid username or password.";
}
