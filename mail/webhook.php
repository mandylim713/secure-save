<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

header('Content-Type: application/json; charset=utf-8');

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed. Use POST.']);
    exit;
}

$rawInput = file_get_contents('php://input');
if (empty($rawInput)) {
    http_response_code(400);
    echo json_encode(['error' => 'Empty webhook payload.']);
    exit;
}

$payload = json_decode($rawInput, true);
if (!is_array($payload)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON payload.']);
    exit;
}

// Log incoming webhook event
$eventType = $payload['type'] ?? 'unknown';
$data = $payload['data'] ?? $payload;

// Process inbound emails
$emailId = $data['email_id'] ?? ($data['id'] ?? ('in_' . time() . '_' . bin2hex(random_bytes(4))));

// Parse Sender
$rawFrom = $data['from'] ?? ($data['sender'] ?? '');
$fromEmail = '';
$fromName = '';

if (is_array($rawFrom)) {
    $fromEmail = $rawFrom['email'] ?? ($rawFrom['address'] ?? '');
    $fromName = $rawFrom['name'] ?? '';
} elseif (is_string($rawFrom)) {
    if (preg_match('/<([^>]+)>/', $rawFrom, $matches)) {
        $fromEmail = trim($matches[1]);
        $fromName = trim(str_replace(['"', "'"], '', explode('<', $rawFrom)[0]));
    } else {
        $fromEmail = trim($rawFrom);
    }
}

if (empty($fromName) && !empty($fromEmail)) {
    $fromName = ucwords(str_replace(['.', '_', '-'], ' ', explode('@', $fromEmail)[0]));
}

// Parse Recipient
$rawTo = $data['to'] ?? ($data['recipient'] ?? MAIL_FROM);
$toEmail = is_array($rawTo) ? implode(', ', array_map(fn($t) => is_array($t) ? ($t['email'] ?? $t['address'] ?? '') : (string)$t, $rawTo)) : (string)$rawTo;

$subject = (string)($data['subject'] ?? '(No Subject)');
$bodyHtml = (string)($data['html'] ?? '');
$bodyText = (string)($data['text'] ?? '');

// If Resend provided only the notification with email_id without bodies, fetch via Inbound Receiving API
if (!empty($data['email_id']) && empty($bodyHtml) && empty($bodyText)) {
    $fetched = fetch_inbound_from_resend($data['email_id']);
    if (!empty($fetched)) {
        $bodyHtml = $fetched['html'] ?? $bodyHtml;
        $bodyText = $fetched['text'] ?? $bodyText;
        if (!empty($fetched['subject'])) $subject = $fetched['subject'];
        if (!empty($fetched['from'])) {
            if (is_string($fetched['from']) && preg_match('/<([^>]+)>/', $fetched['from'], $m)) {
                $fromEmail = trim($m[1]);
                $fromName = trim(str_replace(['"', "'"], '', explode('<', $fetched['from'])[0])) ?: $fromName;
            } elseif (is_string($fetched['from'])) {
                $fromEmail = trim($fetched['from']);
            }
        }
        if (!empty($fetched['to'])) {
            $toEmail = is_array($fetched['to']) ? implode(', ', $fetched['to']) : (string)$fetched['to'];
        }
    }
}

$snippet = mb_substr(strip_tags($bodyText ?: $bodyHtml), 0, 160);
$headersJson = json_encode($data['headers'] ?? []);

try {
    $pdo = get_mail_db();
    $stmt = $pdo->prepare("
        INSERT INTO mail_emails (resend_id, folder, from_address, from_name, to_address, subject, body_html, body_text, snippet, is_read, headers_json, created_at)
        VALUES (?, 'inbox', ?, ?, ?, ?, ?, ?, ?, 0, ?, CURRENT_TIMESTAMP)
    ");
    $stmt->execute([
        $emailId,
        $fromEmail ?: 'unknown@client.com',
        $fromName ?: 'Sender',
        $toEmail ?: MAIL_FROM,
        $subject,
        $bodyHtml,
        $bodyText ?: strip_tags($bodyHtml),
        $snippet,
        $headersJson
    ]);

    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Inbound email received and saved to Inbox.',
        'email_id' => $emailId,
        'subject' => $subject,
        'from' => $fromEmail
    ]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Database storage error',
        'details' => $e->getMessage()
    ]);
}
