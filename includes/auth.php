<?php
// includes/auth.php — сессии, вход/выход, CSRF, flash-сообщения.
// Подключай первым на любой странице, где нужно знать, вошёл ли пользователь.

declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,                       // JS не видит cookie сессии
        'samesite' => 'Lax',                      // базовая защита от CSRF
        'secure'   => !empty($_SERVER['HTTPS']),  // на https — только по https
    ]);
    session_start();
}

function is_logged_in(): bool
{
    return isset($_SESSION['user_id']);
}

/** @return array{id:int,login:string}|null */
function current_user(): ?array
{
    return is_logged_in()
        ? ['id' => (int) $_SESSION['user_id'], 'login' => (string) $_SESSION['login']]
        : null;
}

/** Вызывать сразу после успешной проверки пароля. */
function login_user(array $user): void
{
    session_regenerate_id(true); // новый id сессии: защита от фиксации сессии
    $_SESSION['user_id'] = (int) $user['id'];
    $_SESSION['login']   = (string) $user['login'];
}

function logout_user(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

function redirect(string $path = '/'): never
{
    header('Location: ' . BASE_URL . $path);
    exit;
}

// ---------- CSRF ----------
function csrf_token(): string
{
    return $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function csrf_verify(?string $token): bool
{
    return is_string($token) && hash_equals(csrf_token(), $token);
}

// ---------- flash: сообщение, которое показывается один раз ----------
function flash(string $key, ?string $value = null): ?string
{
    if ($value !== null) {
        $_SESSION['_flash'][$key] = $value;
        return null;
    }
    $v = $_SESSION['_flash'][$key] ?? null;
    unset($_SESSION['_flash'][$key]);
    return $v;
}
