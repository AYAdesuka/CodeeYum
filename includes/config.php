<?php
// includes/config.php — единая точка настроек. Подключай первым в каждой странице.

declare(strict_types=1);

const SITE_NAME = 'CodeeYum';

const BASE_URL = '/ya/CodeeYum';
const BS_CSS    = BASE_URL . '/css/bootstrap/bootstrap.css';
const BS_JS     = BASE_URL . '/js/bootstrap/bootstrap.js';
const THEME_CSS = BASE_URL . '/css/theme.css';
const MONO_CSS  = BASE_URL . '/css/mono.css';

// Пункты меню: путь => подпись
const NAV = [
    BASE_URL . '/'          => 'Главная',
    BASE_URL . '/about.php' => 'О нас',
];

/** Безопасный вывод в HTML. Используй e($var) везде, где печатаешь данные. */
function e(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
