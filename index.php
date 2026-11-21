<?php
$title = 'Главная';
$mono  = true; // JetBrains Mono только здесь
require __DIR__ . '/includes/header.php';
?>

<h1 class="mb-3">Привет, мир</h1>
<p class="text-muted">Дизайн готов — пиши бэкенд.</p>

<div class="row g-4 mt-2">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">Форма</div>
      <div class="card-body">
        <form method="post" action="">
          <div class="mb-3">
            <label class="form-label" for="name">Имя</label>
            <input class="form-control" id="name" name="name" placeholder="Введите имя">
          </div>
          <button class="btn btn-primary" type="submit">Отправить</button>
          <button class="btn btn-outline-primary" type="button">Отмена</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="alert alert-success">Успех</div>
    <div class="alert alert-danger">Ошибка</div>
    <table class="table table-striped table-hover">
      <thead><tr><th>#</th><th>Название</th></tr></thead>
      <tbody>
        <tr><td>1</td><td>Первый</td></tr>
        <tr><td>2</td><td>Второй</td></tr>
      </tbody>
    </table>
  </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
