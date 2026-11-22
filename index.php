<?php
$title = 'Тренажёр PHP/SQL';
require __DIR__ . '/includes/header.php';

// Временные данные: позже заменить выборкой из БД (таблицы topics / tasks)
$tracks = [
  ['cls' => 'sql', 'name' => 'SQL', 'tag' => 'MySQL', 'topics' => [
    ['SELECT и WHERE', 'легко'], ['Сортировка и LIMIT', 'легко'],
    ['Агрегаты и GROUP BY', 'средне'], ['JOIN', 'средне'],
    ['Подзапросы', 'сложно'], ['INSERT / UPDATE / DELETE', 'средне'],
  ]],
  ['cls' => 'php', 'name' => 'PHP', 'tag' => 'PHP 8', 'topics' => [
    ['Переменные и типы', 'легко'], ['Условия и циклы', 'легко'],
    ['Массивы', 'средне'], ['Функции', 'средне'],
    ['Формы и $_POST', 'средне'], ['PDO и MySQL', 'сложно'],
  ]],
];
$steps = [
  ['Выбери тему', 'SQL или PHP, от простого к сложному.'],
  ['Реши задание', 'Пиши код в браузере и запускай его.'],
  ['Получи проверку', 'Результат сверяется с эталоном автоматически.'],
  ['Следи за прогрессом', 'Баллы, история попыток и рейтинг.'],
];
$stats = [['30+', 'заданий'], ['2', 'языка'], ['<5 с', 'на проверку'], ['24/7', 'доступ']];

$errors = []; $ok = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  if ($name === '') $errors[] = 'Введите имя.';
  elseif (mb_strlen($name) > 50) $errors[] = 'Имя не длиннее 50 символов.';
  else $ok = true;
}
?>

<div class="cy-page">

<section class="cy-hero">
  <div>
    <span class="cy-eyebrow">&gt; практика, а не теория</span>
    <h1>Учись писать <span class="cy-hl">SQL</span> и <span class="cy-hl">PHP</span> руками</h1>
    <p class="cy-lead">Решай задания прямо в браузере. Тренажёр сразу проверяет код, показывает ошибки и считает баллы.</p>
    <div class="cy-row">
      <a class="cy-btn" href="<?= e(BASE_URL) ?>/tasks.php">Начать решать</a>
      <a class="cy-btn cy-btn--ghost" href="#tracks">Темы</a>
    </div>
  </div>
  <div class="cy-editor" aria-hidden="true">
    <div class="cy-editor__bar"><i></i><i></i><i></i><span>task_07.sql</span></div>
<pre><span class="cy-dim">-- Покажи клиентов с суммой заказов больше 1000</span>
<span class="cy-kw">SELECT</span> c.name, <span class="cy-fn">SUM</span>(o.total) <span class="cy-kw">AS</span> sum_total
<span class="cy-kw">FROM</span> customers c
<span class="cy-kw">JOIN</span> orders o <span class="cy-kw">ON</span> o.customer_id = c.id
<span class="cy-kw">GROUP BY</span> c.id
<span class="cy-kw">HAVING</span> sum_total &gt; <span class="cy-st">1000</span>;</pre>
    <div class="cy-result">
      <span class="cy-ok">✓ Верно</span> · +10 баллов
      <table><tr><th>name</th><th>sum_total</th></tr>
        <tr><td>Иванов</td><td>1450</td></tr>
        <tr><td>Петрова</td><td>2310</td></tr></table>
    </div>
  </div>
</section>

<div class="cy-stats">
  <?php foreach ($stats as [$num, $label]): ?>
    <div class="cy-stat"><b><?= e($num) ?></b><span><?= e($label) ?></span></div>
  <?php endforeach; ?>
</div>

<section class="cy-section" id="tracks">
  <h2 class="cy-title">Две ветки обучения</h2>
  <p class="cy-sub">Начни с любой, уровень сложности отмечен у каждой темы.</p>
  <div class="cy-grid cy-grid--2">
    <?php foreach ($tracks as $t): ?>
      <div class="cy-card cy-hover cy-track cy-track--<?= e($t['cls']) ?>">
        <h3><?= e($t['name']) ?> <code><?= e($t['tag']) ?></code></h3>
        <ul>
          <?php foreach ($t['topics'] as [$topic, $lvl]): ?>
            <li><span><?= e($topic) ?></span><span class="cy-lvl"><?= e($lvl) ?></span></li>
          <?php endforeach; ?>
        </ul>
        <a class="cy-btn cy-btn--ghost cy-btn--sm" href="<?= e(BASE_URL) ?>/tasks.php?section=<?= e($t['cls']) ?>">Открыть задания</a>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="cy-section">
  <h2 class="cy-title">Как это работает</h2>
  <p class="cy-sub">Четыре шага от задания до результата.</p>
  <div class="cy-grid cy-grid--4">
    <?php foreach ($steps as $i => [$h, $p]): ?>
      <div class="cy-card cy-hover cy-step"><div class="n"><?= $i + 1 ?></div><h4><?= e($h) ?></h4><p><?= e($p) ?></p></div>
    <?php endforeach; ?>
  </div>
</section>

<section class="cy-section">
  <div class="cy-grid cy-grid--2">
    <div class="cy-card">
      <h3>Подписаться на новые задания</h3>
      <?php if ($ok): ?><div class="cy-alert cy-alert--ok">Спасибо, <?= e($name) ?>!</div><?php endif; ?>
      <?php foreach ($errors as $er): ?><div class="cy-alert cy-alert--err"><?= e($er) ?></div><?php endforeach; ?>
      <form method="post" action="">
        <div class="cy-field">
          <label for="name">Имя</label>
          <input class="cy-input" id="name" name="name" placeholder="Введите имя" value="<?= e($_POST['name'] ?? '') ?>" required maxlength="50">
        </div>
        <div class="cy-row">
          <button class="cy-btn" type="submit">Отправить</button>
          <button class="cy-btn cy-btn--ghost" type="reset">Отмена</button>
        </div>
      </form>
    </div>
    <div class="cy-card">
      <h3>Последние задания</h3>
      <table class="cy-table">
        <thead><tr><th>#</th><th>Название</th></tr></thead>
        <tbody>
          <tr><td class="font-mono">1</td><td>SELECT: выбрать всех клиентов</td></tr>
          <tr><td class="font-mono">2</td><td>PHP: сумма элементов массива</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

</div>

<?php require __DIR__ . '/includes/footer.php'; ?>