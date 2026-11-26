<?php
$title = 'Задания';
require __DIR__ . '/../includes/header.php';
$user = current_user();
?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
  <div>
    <h1 class="mb-1">Задания</h1>
    <p class="text-muted mb-0">Привет, <?= e($user['login']) ?>. Выбери тему и решай.</p>
  </div>
  <form method="post" action="<?= e(BASE_URL) ?>/logout.php">
    <?= csrf_field() ?>
    <button class="btn btn-outline-primary" type="submit">Выйти</button>
  </form>
</div>

<div class="row g-4">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">SQL <span class="badge">MySQL</span></div>
      <div class="list-group list-group-flush">
        <a class="list-group-item" href="#">SELECT и WHERE</a>
        <a class="list-group-item" href="#">Сортировка и LIMIT</a>
        <a class="list-group-item" href="#">JOIN и GROUP BY</a>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">PHP <span class="badge">PHP 8</span></div>
      <div class="list-group list-group-flush">
        <a class="list-group-item" href="#">Переменные и типы</a>
        <a class="list-group-item" href="#">Условия и циклы</a>
        <a class="list-group-item" href="#">Функции и массивы</a>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>