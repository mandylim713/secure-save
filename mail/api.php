<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

header('Content-Type: application/json; charset=utf-8');

// Ensure user is authenticated
if (empty($_SESSION['mail_user'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$pdo = get_mail_db();
$action = $_GET['action'] ?? ($_POST['action'] ?? '');

switch ($action) {
    case 'get_email':
        $id = (int)($_GET['id'] ?? 0);
        $stmt = $pdo->prepare("SELECT * FROM mail_emails WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $email = $stmt->fetch();
        if (!$email) {
            http_response_code(404);
            echo json_encode(['error' => 'Email not found']);
            exit;
        }

        // Auto-mark as read
        if (empty($email['is_read'])) {
            $pdo->prepare("UPDATE mail_emails SET is_read = 1 WHERE id = ?")->execute([$id]);
            $email['is_read'] = 1;
        }

        echo json_encode(['success' => true, 'email' => $email]);
        break;

    case 'toggle_star':
        $id = (int)($_POST['id'] ?? 0);
        $stmt = $pdo->prepare("UPDATE mail_emails SET is_starred = CASE WHEN is_starred = 1 THEN 0 ELSE 1 END WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
        break;

    case 'mark_read':
        $id = (int)($_POST['id'] ?? 0);
        $pdo->prepare("UPDATE mail_emails SET is_read = 1 WHERE id = ?")->execute([$id]);
        echo json_encode(['success' => true]);
        break;

    case 'mark_unread':
        $id = (int)($_POST['id'] ?? 0);
        $pdo->prepare("UPDATE mail_emails SET is_read = 0 WHERE id = ?")->execute([$id]);
        echo json_encode(['success' => true]);
        break;

    case 'delete':
        $id = (int)($_POST['id'] ?? 0);
        // If already in trash, delete permanently; otherwise move to trash
        $stmt = $pdo->prepare("SELECT folder FROM mail_emails WHERE id = ?");
        $stmt->execute([$id]);
        $folder = $stmt->fetchColumn();

        if ($folder === 'trash') {
            $pdo->prepare("DELETE FROM mail_emails WHERE id = ?")->execute([$id]);
        } else {
            $pdo->prepare("UPDATE mail_emails SET folder = 'trash' WHERE id = ?")->execute([$id]);
        }
        echo json_encode(['success' => true]);
        break;

    case 'simulate_inbound':
        $testSender = trim((string)($_POST['sender'] ?? 'client.inquiry@gmail.com'));
        $testName = trim((string)($_POST['sender_name'] ?? 'David Miller'));
        $testSubject = trim((string)($_POST['subject'] ?? 'Inquiry regarding my Secure Save Account Verification'));
        $testBody = trim((string)($_POST['body'] ?? "Hello Support Team,\n\nI recently submitted my identification documents for verification on Secure Save Hub. Could you please confirm if they have been reviewed and approved?\n\nThank you,\nDavid Miller"));

        $msgId = 'sim_' . time() . '_' . bin2hex(random_bytes(4));
        $snippet = mb_substr(strip_tags($testBody), 0, 160);

        $stmt = $pdo->prepare("
            INSERT INTO mail_emails (resend_id, folder, from_address, from_name, to_address, subject, body_html, body_text, snippet, is_read, created_at)
            VALUES (?, 'inbox', ?, ?, ?, ?, ?, ?, ?, 0, CURRENT_TIMESTAMP)
        ");
        $stmt->execute([
            $msgId,
            $testSender,
            $testName,
            MAIL_FROM,
            $testSubject,
            nl2br(htmlspecialchars($testBody)),
            $testBody,
            $snippet
        ]);

        echo json_encode(['success' => true, 'message' => 'Simulated inbound email delivered to Inbox!']);
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
        break;
}
