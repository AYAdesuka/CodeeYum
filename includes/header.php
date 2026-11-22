<?php
// includes/header.php
// Перед подключением можно задать (всё необязательно):
//   $title     = 'Заголовок страницы';
//   $extra_css = ['home.css'];   // доп. стили страницы из css/

require_once __DIR__ . '/config.php';

$title     = $title ?? SITE_NAME;
$extra_css = $extra_css ?? [];
$current   = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$css_dir   = BASE_URL . '/css/';
?>
<!doctype html>
<html lang="ru" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title) ?> — <?= SITE_NAME ?></title>

  <!-- порядок важен: Bootstrap -> шрифты -> переменные темы -> общие стили -> стили страницы -->
  <link rel="stylesheet" href="<?= BS_CSS ?>">
  <link rel="stylesheet" href="<?= $css_dir ?>fonts.css">
  <link rel="stylesheet" href="<?= THEME_CSS ?>">
  <link rel="stylesheet" href="<?= $css_dir ?>style.css">
  <?php foreach ($extra_css as $file): ?>
  <link rel="stylesheet" href="<?= $css_dir . e($file) ?>">
  <?php endforeach; ?>
</head>
<body>

<header class="site-header py-3">
  <div class="container d-flex flex-wrap align-items-center justify-content-between gap-3">
    <a class="brand fs-5" href="<?= BASE_URL ?>/"><?= SITE_NAME ?></a>
    <nav>
      <ul class="site-nav">
        <?php foreach (NAV as $href => $label): ?>
          <li><a href="<?= $href ?>"<?= $href === $current ? ' class="active" aria-current="page"' : '' ?>><?= $label ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
  </div>
</header>

<main class="site-main container py-5">