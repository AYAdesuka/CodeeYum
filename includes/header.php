<?php
// includes/header.php
// Перед подключением задай (необязательно):
//   $title = 'Заголовок страницы';
//   $mono  = true;   // включить JetBrains Mono (нужно только на index.php)

require_once __DIR__ . '/config.php';

$title = $title ?? SITE_NAME;
$mono  = $mono ?? false;
$current = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
?>
<!doctype html>
<html lang="ru" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title) ?> — <?= e(SITE_NAME) ?></title>

  <?php if ($mono): ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
  <?php endif; ?>

  <link rel="stylesheet" href="<?= e(BS_CSS) ?>">
  <link rel="stylesheet" href="<?= e(THEME_CSS) ?>">
  <?php if ($mono): ?>
  <link rel="stylesheet" href="<?= e(MONO_CSS) ?>">
  <?php endif; ?>
</head>
<body<?= $mono ? ' class="font-jb"' : '' ?>>

<header class="site-header py-3">
  <div class="container d-flex flex-wrap align-items-center justify-content-between gap-3">
    <a class="brand fs-5" href="<?= e(BASE_URL) ?>/"><?= e(SITE_NAME) ?></a>
    <nav>
      <ul class="site-nav">
        <?php foreach (NAV as $href => $label): ?>
          <li><a href="<?= e($href) ?>"<?= $href === $current ? ' class="active" aria-current="page"' : '' ?>><?= e($label) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
  </div>
</header>

<main class="site-main container py-5">
