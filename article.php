<?php
session_start();

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=teeninsights", "root", "");

// Get article ID
$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($article['title'] ?? 'Article Not Found') ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="news-page general-subpage">
<header>
  <h1><?= htmlspecialchars($article['title'] ?? 'Not Found') ?></h1>
</header>
<main class="content">
  <?php if ($article): ?>
    <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
  <?php else: ?>
    <p>Sorry, this article could not be found.</p>
  <?php endif; ?>
</main>
</body>
</html>
