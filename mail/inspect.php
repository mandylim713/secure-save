<?php
declare(strict_types=1);

if (($_GET['key'] ?? '') !== 'securesave_secret_9981') {
    http_response_code(403);
    die('Forbidden');
}

require_once __DIR__ . '/db.php';
$pdo = get_mail_db();

header('Content-Type: application/json; charset=utf-8');

try {
    // 1. Get total user count
    $totalCount = (int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

    // 2. Get last registered users
    $stmt = $pdo->query("SELECT id, name, username, email, phone, country, account_number, account_bal, status, created_at FROM users ORDER BY id DESC LIMIT 15");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 3. Get admin users
    $adminStmt = $pdo->query("SELECT id, firstName, lastName, email FROM admins");
    $admins = $adminStmt->fetchAll(PDO::FETCH_ASSOC);

    // 4. Get table row counts for key tables
    $tables = ['users', 'admins', 'deposits', 'withdrawals', 'tp__transactions', 'kycs', 'userlogs', 'mail_emails'];
    $tableCounts = [];
    foreach ($tables as $t) {
        try {
            $tableCounts[$t] = (int)$pdo->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();
        } catch (Throwable $e) {
            $tableCounts[$t] = 'table missing';
        }
    }

    echo json_encode([
        'success' => true,
        'database' => 'connected',
        'total_users' => $totalCount,
        'last_users' => $users,
        'admins' => $admins,
        'table_counts' => $tableCounts,
    ], JSON_PRETTY_PRINT);
} catch (Throwable $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_PRETTY_PRINT);
}
