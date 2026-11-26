<?php
// includes/users.php — доступ к пользователям. ЕДИНСТВЕННОЕ место, которое нужно
// подогнать под твою БД: параметры подключения и имена таблицы/колонок.

declare(strict_types=1);

function db(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO(
            getenv('CODEEYUM_DSN') ?: 'mysql:host=localhost;dbname=codeeyum;charset=utf8mb4',
            getenv('CODEEYUM_DB_USER') ?: 'root',   // XAMPP: root без пароля
            getenv('CODEEYUM_DB_PASS') ?: '',
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]
        );
    }
    return $pdo;
}

function find_user(string $login): ?array
{
    $st = db()->prepare('SELECT id, login, password_hash FROM users WHERE login = :l LIMIT 1');
    $st->execute([':l' => $login]);
    return $st->fetch() ?: null;
}

/** Возвращает пользователя при верном пароле, иначе null. */
function attempt_login(string $login, string $password): ?array
{
    $user = find_user($login);

    // Проверяем пароль даже если логина нет — одинаковое время ответа,
    // чтобы нельзя было перебором узнать, какие логины существуют.
    $hash = $user['password_hash'] ?? '$2y$10$usesomesillystringforsalt.eMqXw1T3b9o8d7ZKq5tG2n1h3v0e';
    $ok   = password_verify($password, $hash);
    if (!$user || !$ok) {
        return null;
    }

    if (password_needs_rehash($user['password_hash'], PASSWORD_DEFAULT)) {
        db()->prepare('UPDATE users SET password_hash = :h WHERE id = :id')
            ->execute([':h' => password_hash($password, PASSWORD_DEFAULT), ':id' => $user['id']]);
    }
    return $user;
}
