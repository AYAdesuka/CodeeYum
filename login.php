<?php

require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/users.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/');
}
if (!csrf_verify($_POST['csrf'] ?? null)) {
    flash('error', 'Сессия устарела. Войдите ещё раз.');
    redirect('/');
}

$login = trim((string) ($_POST['login'] ?? ''));
$password = (string) ($_POST['password'] ?? '');
$user = ($login !== '' && $password !== '') ? attempt_login($login, $password) : null;

if (!$user) {
    flash('error', 'Неверный логин или пароль.');
    flash('old_login', $login);
    redirect('/');
}

login_user($user);
redirect('/');

?>