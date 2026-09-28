<?php

declare(strict_types=1);

session_start();

require __DIR__ . '/data.php';

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function request_path(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
    if ($base !== '' && $base !== '/' && str_starts_with($path, $base)) {
        $path = substr($path, strlen($base)) ?: '/';
    }
    $path = '/' . trim($path, '/');
    return $path === '/' ? '/' : rtrim($path, '/');
}

function url(string $path = '/'): string
{
    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
    if ($base === '/' || $base === '.') {
        $base = '';
    }
    if ($path === '/' || $path === '') {
        return ($base === '' ? '' : $base) . '/';
    }
    return $base . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
    return url('assets/' . ltrim($path, '/'));
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function csrf_valid(): bool
{
    $sent = $_POST['csrf'] ?? '';
    return is_string($sent) && isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $sent);
}

function flash(?string $type = null, ?string $message = null): ?array
{
    if ($type !== null) {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
        return null;
    }
    if (empty($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}

function old(string $key, string $default = ''): string
{
    $old = $_SESSION['old'] ?? [];
    return isset($old[$key]) ? (string) $old[$key] : $default;
}

function set_old(array $data): void
{
    $_SESSION['old'] = $data;
}

function clear_old(): void
{
    unset($_SESSION['old']);
}

function storage_path(string $file): string
{
    $dir = dirname(__DIR__) . '/storage';
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
    return $dir . '/' . $file;
}

function read_json(string $file): array
{
    $path = storage_path($file);
    if (!is_file($path)) {
        return [];
    }
    $raw = file_get_contents($path);
    $data = json_decode($raw ?: '[]', true);
    return is_array($data) ? $data : [];
}

function write_json(string $file, array $data): void
{
    $path = storage_path($file);
    $fp = fopen($path, 'c+');
    if ($fp === false) {
        throw new RuntimeException('Unable to store submission.');
    }
    flock($fp, LOCK_EX);
    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
}

function append_json(string $file, array $row): void
{
    $rows = read_json($file);
    $rows[] = $row;
    write_json($file, $rows);
}

function current_nav(string $href): string
{
    $path = request_path();
    $target = rtrim($href, '/') ?: '/';
    if ($target === '/') {
        return $path === '/' ? ' is-active' : '';
    }
    return str_starts_with($path, $target) ? ' is-active' : '';
}

function render(string $view, array $data = []): void
{
    extract($data, EXTR_SKIP);
    $pageTitle = $pageTitle ?? 'OMNITECH Systems';
    $pageDescription = $pageDescription ?? 'OMNITECH Systems is a Commercial and Federal Enterprise IT solutions provider.';
    include __DIR__ . '/header.php';
    include __DIR__ . '/pages/' . $view;
    include __DIR__ . '/footer.php';
}

function render_404(): void
{
    http_response_code(404);
    render('404.php', [
        'pageTitle' => 'Page not found — OMNITECH Systems',
        'pageDescription' => 'The page you requested could not be found.',
    ]);
}
