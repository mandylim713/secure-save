<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

function get_mail_db(): PDO {
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $isMysql = false;
    $host = getenv('DB_HOST') ?: getenv('MYSQLHOST');
    $dbName = getenv('DB_DATABASE') ?: getenv('MYSQLDATABASE') ?: 'railway';
    $user = getenv('DB_USERNAME') ?: getenv('MYSQLUSER') ?: 'root';
    $pass = getenv('DB_PASSWORD') ?: getenv('MYSQLPASSWORD') ?: '';
    $port = getenv('DB_PORT') ?: getenv('MYSQLPORT') ?: '3306';

    if ($host && extension_loaded('pdo_mysql')) {
        try {
            $pdo = new PDO("mysql:host={$host};port={$port};dbname={$dbName};charset=utf8mb4", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            $isMysql = true;
        } catch (Throwable $e) {
            // fall through to sqlite
        }
    }

    if (!$pdo) {
        $storageDir = dirname(__DIR__) . '/storage';
        if (!is_dir($storageDir)) {
            @mkdir($storageDir, 0777, true);
        }
        $dbFile = $storageDir . '/mail.sqlite';
        $pdo = new PDO("sqlite:" . $dbFile, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        $isMysql = false;
    }

    init_mail_tables($pdo, $isMysql);
    return $pdo;
}

function init_mail_tables(PDO $pdo, bool $isMysql): void {
    if ($isMysql) {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS mail_users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(100) NOT NULL UNIQUE,
                email VARCHAR(150) NOT NULL UNIQUE,
                password_hash VARCHAR(255) NOT NULL,
                role VARCHAR(50) DEFAULT 'admin',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            CREATE TABLE IF NOT EXISTS mail_emails (
                id INT AUTO_INCREMENT PRIMARY KEY,
                resend_id VARCHAR(100) NULL,
                folder VARCHAR(50) NOT NULL DEFAULT 'inbox',
                from_address VARCHAR(255) NOT NULL,
                from_name VARCHAR(150) NULL,
                to_address VARCHAR(255) NOT NULL,
                subject VARCHAR(300) NULL,
                body_html LONGTEXT NULL,
                body_text LONGTEXT NULL,
                snippet VARCHAR(255) NULL,
                is_read TINYINT(1) DEFAULT 0,
                is_starred TINYINT(1) DEFAULT 0,
                headers_json LONGTEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_folder (folder),
                INDEX idx_read (is_read),
                INDEX idx_created (created_at)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            CREATE TABLE IF NOT EXISTS mail_settings (
                key_name VARCHAR(100) PRIMARY KEY,
                val TEXT NULL,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
    } else {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS mail_users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT UNIQUE NOT NULL,
                email TEXT UNIQUE NOT NULL,
                password_hash TEXT NOT NULL,
                role TEXT DEFAULT 'admin',
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS mail_emails (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                resend_id TEXT,
                folder TEXT NOT NULL DEFAULT 'inbox',
                from_address TEXT NOT NULL,
                from_name TEXT,
                to_address TEXT NOT NULL,
                subject TEXT,
                body_html TEXT,
                body_text TEXT,
                snippet TEXT,
                is_read INTEGER DEFAULT 0,
                is_starred INTEGER DEFAULT 0,
                headers_json TEXT,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS mail_settings (
                key_name TEXT PRIMARY KEY,
                val TEXT,
                updated_at TEXT DEFAULT CURRENT_TIMESTAMP
            );
        ");
    }

    // Seed default admin if missing
    try {
        $st = $pdo->query("SELECT COUNT(*) FROM mail_users");
        if ((int)$st->fetchColumn() === 0) {
            $defaultPass = password_hash('SecureSave#Mail2026!', PASSWORD_DEFAULT);
            $st2 = $pdo->prepare("INSERT INTO mail_users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
            $st2->execute(['support', 'support@secure-savehub.com', $defaultPass, 'admin']);
        }
    } catch (Throwable $e) {}

    // Seed default Resend API key if missing
    try {
        $stKey = $pdo->query("SELECT COUNT(*) FROM mail_settings WHERE key_name = 'resend_api_key'");
        if ((int)$stKey->fetchColumn() === 0) {
            $pdo->prepare("INSERT INTO mail_settings (key_name, val) VALUES ('resend_api_key', ?)")
                ->execute([DEFAULT_RESEND_KEY]);
        }
    } catch (Throwable $e) {}
}

function get_resend_api_key(): string {
    $env = getenv('RESEND_API_KEY');
    if (!empty($env)) {
        return trim($env);
    }
    try {
        $pdo = get_mail_db();
        $st = $pdo->query("SELECT val FROM mail_settings WHERE key_name = 'resend_api_key' LIMIT 1");
        $saved = $st->fetchColumn();
        if (!empty($saved)) {
            return trim((string)$saved);
        }
    } catch (Throwable $e) {}
    return DEFAULT_RESEND_KEY;
}

function send_resend_email(string $to, string $subject, string $bodyHtml, string $bodyText = '', ?string $from = null, ?string $replyTo = null): array {
    $key = get_resend_api_key();
    if (empty($key)) {
        return ['ok' => false, 'error' => 'Resend API key is not configured.'];
    }

    $fromAddress = $from ?: (MAIL_FROM_NAME . ' <' . MAIL_FROM . '>');
    $payload = [
        'from' => $fromAddress,
        'to' => [$to],
        'subject' => $subject,
        'html' => $bodyHtml,
    ];
    if (!empty($bodyText)) {
        $payload['text'] = $bodyText;
    }
    if (!empty($replyTo)) {
        $payload['reply_to'] = $replyTo;
    }

    $ch = curl_init('https://api.resend.com/emails');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $key,
            'Content-Type: application/json',
            'User-Agent: SecureSaveMail/1.0',
        ],
        CURLOPT_TIMEOUT => 15,
    ]);

    $raw = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
        return ['ok' => false, 'error' => 'cURL error: ' . $err];
    }

    $data = json_decode((string)$raw, true) ?: [];
    if ($status >= 200 && $status < 300 && !empty($data['id'])) {
        // Save outgoing email into 'sent' folder
        try {
            $pdo = get_mail_db();
            $snippet = mb_substr(strip_tags($bodyText ?: $bodyHtml), 0, 160);
            $stmt = $pdo->prepare("
                INSERT INTO mail_emails (resend_id, folder, from_address, from_name, to_address, subject, body_html, body_text, snippet, is_read, created_at)
                VALUES (?, 'sent', ?, ?, ?, ?, ?, ?, ?, 1, CURRENT_TIMESTAMP)
            ");
            $stmt->execute([
                $data['id'],
                MAIL_FROM,
                MAIL_FROM_NAME,
                $to,
                $subject,
                $bodyHtml,
                $bodyText ?: strip_tags($bodyHtml),
                $snippet,
            ]);
        } catch (Throwable $e) {}

        return ['ok' => true, 'id' => $data['id']];
    }

    $msg = $data['message'] ?? ($data['error']['message'] ?? "HTTP error {$status}: {$raw}");
    return ['ok' => false, 'error' => $msg];
}

function fetch_inbound_from_resend(string $emailId): ?array {
    $key = get_resend_api_key();
    if (empty($key)) return null;

    $ch = curl_init("https://api.resend.com/emails/receiving/{$emailId}");
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $key,
            'User-Agent: SecureSaveMail/1.0',
        ],
        CURLOPT_TIMEOUT => 15,
    ]);

    $raw = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status >= 200 && $status < 300) {
        return json_decode((string)$raw, true);
    }
    return null;
}

function get_folder_counts(PDO $pdo): array {
    $inbox = (int)$pdo->query("SELECT COUNT(*) FROM mail_emails WHERE folder = 'inbox'")->fetchColumn();
    $unread = (int)$pdo->query("SELECT COUNT(*) FROM mail_emails WHERE folder = 'inbox' AND is_read = 0")->fetchColumn();
    $sent = (int)$pdo->query("SELECT COUNT(*) FROM mail_emails WHERE folder = 'sent'")->fetchColumn();
    $starred = (int)$pdo->query("SELECT COUNT(*) FROM mail_emails WHERE is_starred = 1 AND folder != 'trash'")->fetchColumn();
    $trash = (int)$pdo->query("SELECT COUNT(*) FROM mail_emails WHERE folder = 'trash'")->fetchColumn();

    return [
        'inbox' => $inbox,
        'unread' => $unread,
        'sent' => $sent,
        'starred' => $starred,
        'trash' => $trash,
    ];
}
