</main>

<footer class="site-footer py-4 mt-5">
  <div class="container small">
    &copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>
  </div>
</footer>

<script type="module">
  // Bootstrap 6 — только ESM, глобального window.bootstrap больше нет.
  import * as bootstrap from '<?= e(BS_JS) ?>';
  window.bootstrap = bootstrap; // если нужно дергать из своих скриптов
</script>
</body>
</html>
