<?php
session_start();

// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=teeninsights", "root", "");

// Get search query
$q = trim($_GET['q'] ?? '');

if ($q) {
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE title LIKE ? OR content LIKE ? ORDER BY published_date DESC");
    $searchTerm = "%$q%";
    $stmt->execute([$searchTerm, $searchTerm]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $results = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Results</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="news-page general-subpage">
<header>
  <h1>Search Results for "<?= htmlspecialchars($q) ?>"</h1>
</header>
<main class="content">
  <?php if ($results): ?>
    <?php foreach ($results as $article): ?>
      <article class="article">
        <h2><?= htmlspecialchars($article['title']) ?></h2>
        <p><?= htmlspecialchars(substr($article['content'], 0, 150)) ?>...</p>
        <a href="article.php?id=<?= $article['id'] ?>" class="read-more">Read more</a>
      </article>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No articles found.</p>
  <?php endif; ?>
</main>
</body>
</html>
