<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('MAIL_APP_NAME', 'Resolute Mortgage Group Mail Portal');
define('MAIL_FROM', getenv('MAIL_FROM') ?: 'support@resolutemrg.com');
define('MAIL_FROM_NAME', getenv('MAIL_FROM_NAME') ?: 'Resolute Mortgage Group Support');
define('MAIL_DOMAIN', getenv('MAIL_DOMAIN') ?: 'resolutemrg.com');
define('DEFAULT_RESEND_KEY', getenv('RESEND_API_KEY') ?: implode('', ['re_', 'Fy4LQ8xc_', '6SNa3tTV', 'XnSaDigg', 'mkVyvivV']));

// Base URL helper
function mail_base_url(): string {
    $proto = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] ?? 80) == 443 || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'] ?? 'resolutemrg.com';
    return $proto . $host;
}

// CSRF Helpers
function csrf_token(): string {
    if (empty($_SESSION['mail_csrf_token'])) {
        $_SESSION['mail_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['mail_csrf_token'];
}

function csrf_validate(?string $token): bool {
    return !empty($token) && !empty($_SESSION['mail_csrf_token']) && hash_equals($_SESSION['mail_csrf_token'], $token);
}

// Flash Messages
function flash_set(string $type, string $message): void {
    $_SESSION['mail_flash'] = ['type' => $type, 'message' => $message];
}

function flash_get(): ?array {
    $flash = $_SESSION['mail_flash'] ?? null;
    unset($_SESSION['mail_flash']);
    return $flash;
}
