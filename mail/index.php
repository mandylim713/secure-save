<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

$pdo = get_mail_db();
$error = '';
$flash = flash_get();

// ------------------------------------------------------------------
// 1. AUTHENTICATION CONTROLLER
// ------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'login') {
    if (!csrf_validate($_POST['csrf_token'] ?? '')) {
        $error = 'Security session expired. Please refresh and try again.';
    } else {
        $ident = trim((string)($_POST['identifier'] ?? ''));
        $pass = (string)($_POST['password'] ?? '');

        $st = $pdo->prepare('SELECT * FROM mail_users WHERE username = ? OR email = ? LIMIT 1');
        $st->execute([$ident, $ident]);
        $user = $st->fetch();

        if ($user && password_verify($pass, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['mail_user'] = [
                'id'       => $user['id'],
                'username' => $user['username'],
                'email'    => $user['email'],
                'role'     => $user['role'],
            ];
            header('Location: index.php');
            exit;
        }
        $error = 'Invalid credentials. Please verify your email and password.';
    }
}

if (isset($_GET['logout'])) {
    unset($_SESSION['mail_user']);
    session_regenerate_id(true);
    header('Location: index.php');
    exit;
}

$authed = !empty($_SESSION['mail_user']);
$currentUser = $_SESSION['mail_user'] ?? null;

// ------------------------------------------------------------------
// 2. AUTHORIZED ACTIONS (SEND, SETTINGS, PASSWORD)
// ------------------------------------------------------------------
if ($authed && $_SERVER['REQUEST_METHOD'] === 'POST' && csrf_validate($_POST['csrf_token'] ?? '')) {
    $act = $_POST['action'] ?? '';

    // Action: Send Outgoing Email
    if ($act === 'send_email') {
        $to = trim((string)($_POST['to'] ?? ''));
        $subject = trim((string)($_POST['subject'] ?? ''));
        $senderName = trim((string)($_POST['sender_name'] ?? MAIL_FROM_NAME)) ?: MAIL_FROM_NAME;
        $bodyHtml = (string)($_POST['body_html'] ?? '');
        $bodyText = (string)($_POST['body_text'] ?? strip_tags($bodyHtml));
        $replyTo = trim((string)($_POST['reply_to'] ?? ''));

        if (empty($to) || !filter_var($to, FILTER_VALIDATE_EMAIL)) {
            flash_set('error', 'Please enter a valid recipient email address.');
            header('Location: index.php?view=compose');
            exit;
        }

        if (empty($subject)) {
            flash_set('error', 'Subject line cannot be blank.');
            header('Location: index.php?view=compose');
            exit;
        }

        $fromStr = "{$senderName} <" . MAIL_FROM . ">";
        $res = send_resend_email($to, $subject, $bodyHtml ?: nl2br(htmlspecialchars($bodyText)), $bodyText, $fromStr, $replyTo ?: null);

        if (!empty($res['ok'])) {
            flash_set('success', "Email successfully dispatched to {$to} (Resend ID: {$res['id']}).");
            header('Location: index.php?folder=sent');
            exit;
        } else {
            flash_set('error', 'Failed to dispatch email: ' . ($res['error'] ?? 'Unknown error'));
            header('Location: index.php?view=compose');
            exit;
        }
    }

    // Action: Save Resend API Key
    if ($act === 'save_resend_key') {
        $newKey = trim((string)($_POST['resend_api_key'] ?? ''));
        if (!empty($newKey)) {
            $st = $pdo->prepare("SELECT COUNT(*) FROM mail_settings WHERE key_name = 'resend_api_key'");
            $st->execute();
            if ((int)$st->fetchColumn() > 0) {
                $pdo->prepare("UPDATE mail_settings SET val = ? WHERE key_name = 'resend_api_key'")->execute([$newKey]);
            } else {
                $pdo->prepare("INSERT INTO mail_settings (key_name, val) VALUES ('resend_api_key', ?)")->execute([$newKey]);
            }
            flash_set('success', 'Resend API key updated successfully.');
        }
        header('Location: index.php?view=settings');
        exit;
    }

    // Action: Send Live Diagnostic Test
    if ($act === 'test_diagnostic') {
        $testTo = trim((string)($_POST['test_to'] ?? ''));
        if (empty($testTo) || !filter_var($testTo, FILTER_VALIDATE_EMAIL)) {
            $testTo = 'support@resolutemrg.com';
        }

        $testHtml = '
        <div style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.05);">
            <div style="background:#0f172a;padding:24px;text-align:center;color:#ffffff;">
                <h2 style="margin:0;font-size:20px;font-weight:700;letter-spacing:-0.5px;">Resolute MRG Hub</h2>
                <p style="margin:6px 0 0;font-size:13px;color:#94a3b8;">Official Mailbox System Verification</p>
            </div>
            <div style="padding:28px 24px;background:#ffffff;color:#334155;line-height:1.6;">
                <h3 style="color:#0f172a;margin-top:0;">Live Email Dispatch Test</h3>
                <p>Hello,</p>
                <p>This is a live diagnostic verification dispatched from your dedicated <strong>Resolute MRG Hub Mailbox</strong> via the <strong>Resend API</strong>.</p>
                <div style="background:#f8fafc;border-left:4px solid #3b82f6;padding:12px 16px;border-radius:4px;margin:18px 0;font-size:14px;">
                    <strong>Sender:</strong> ' . htmlspecialchars(MAIL_FROM) . '<br>
                    <strong>Domain Status:</strong> Verified (resolutemrg.com)<br>
                    <strong>Timestamp:</strong> ' . date('r') . '
                </div>
                <p>If you have received this message, your Resend API integration and mailing service are operating at 100% capacity.</p>
            </div>
            <div style="background:#f8fafc;padding:16px 24px;text-align:center;font-size:12px;color:#64748b;border-top:1px solid #e2e8f0;">
                &copy; ' . date('Y') . ' Resolute MRG Hub. All rights reserved.
            </div>
        </div>';

        $res = send_resend_email($testTo, 'Resolute MRG Mail Verification — ' . date('Y-m-d H:i'), $testHtml, strip_tags($testHtml));
        if (!empty($res['ok'])) {
            flash_set('success', "Diagnostic test successfully dispatched to {$testTo} (Resend ID: {$res['id']}).");
        } else {
            flash_set('error', 'Diagnostic test failed: ' . ($res['error'] ?? 'Unknown error'));
        }
        header('Location: index.php?view=settings');
        exit;
    }

    // Action: Change Password
    if ($act === 'change_password') {
        $curPass = (string)($_POST['cur_password'] ?? '');
        $newPass = (string)($_POST['new_password'] ?? '');
        $newPass2 = (string)($_POST['new_password2'] ?? '');

        $st = $pdo->prepare('SELECT password_hash FROM mail_users WHERE id = ?');
        $st->execute([$currentUser['id']]);
        $hash = $st->fetchColumn();

        if (!$hash || !password_verify($curPass, $hash)) {
            flash_set('error', 'Current password was entered incorrectly.');
        } elseif (strlen($newPass) < 8) {
            flash_set('error', 'New password must be at least 8 characters long.');
        } elseif ($newPass !== $newPass2) {
            flash_set('error', 'New passwords do not match.');
        } else {
            $pdo->prepare('UPDATE mail_users SET password_hash = ? WHERE id = ?')
                ->execute([password_hash($newPass, PASSWORD_DEFAULT), $currentUser['id']]);
            flash_set('success', 'Your password has been successfully updated.');
        }
        header('Location: index.php?view=settings');
        exit;
    }
}

// If not authenticated, render Login Screen
if (!$authed) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login &bull; Resolute MRG Mail Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0b0f19;
            --card-bg: #111827;
            --border: #1f2937;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --text-main: #f9fafb;
            --text-muted: #9ca3af;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .login-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            width: 100%;
            max-width: 440px;
            padding: 36px 32px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }
        .logo-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }
        .logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 800;
            font-size: 20px;
        }
        .logo-text h1 { font-size: 18px; font-weight: 700; color: #fff; }
        .logo-text p { font-size: 13px; color: var(--text-muted); }
        .alert {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid #ef4444;
            color: #fca5a5;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 13.5px;
            margin-bottom: 20px;
        }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #d1d5db; }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            background: #1f2937;
            border: 1px solid #374151;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            outline: none;
            transition: border-color 0.15s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: var(--primary);
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.15s;
        }
        .btn-submit:hover { background: var(--primary-hover); }
        .hint-box {
            margin-top: 24px;
            padding: 14px;
            background: rgba(37, 99, 235, 0.08);
            border: 1px dashed rgba(59, 130, 246, 0.3);
            border-radius: 8px;
            font-size: 12px;
            color: #93c5fd;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-row">
            <div class="logo-icon">&#9993;</div>
            <div class="logo-text">
                <h1>Resolute MRG Mail</h1>
                <p>Support &amp; Dispatch Portal</p>
            </div>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php">
            <input type="hidden" name="action" value="login">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">

            <div class="form-group">
                <label>Email or Username</label>
                <input type="text" name="identifier" value="support@resolutemrg.com" required autofocus autocomplete="username">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required autocomplete="current-password" placeholder="••••••••••••">
            </div>

            <button type="submit" class="btn-submit">Sign In to Mailbox</button>
        </form>

        <div class="hint-box">
            <strong>Default Credentials:</strong><br>
            Email: <code>support@resolutemrg.com</code><br>
            Password: <code>SecureSave#Mail2026!</code>
        </div>
    </div>
</body>
</html>
<?php
exit;
}

// ------------------------------------------------------------------
// 3. AUTHENTICATED PORTAL VIEW
// ------------------------------------------------------------------
$folder = $_GET['folder'] ?? 'inbox';
$view = $_GET['view'] ?? 'list';
$search = trim((string)($_GET['q'] ?? ''));

// Fetch folder counts
$counts = get_folder_counts($pdo);

// Query emails for current folder
$emails = [];
if ($folder === 'starred') {
    $sql = "SELECT * FROM mail_emails WHERE is_starred = 1 AND folder != 'trash'";
    $params = [];
} else {
    $sql = "SELECT * FROM mail_emails WHERE folder = ?";
    $params = [$folder];
}

if (!empty($search)) {
    $sql .= " AND (from_address LIKE ? OR to_address LIKE ? OR subject LIKE ? OR snippet LIKE ?)";
    $like = '%' . $search . '%';
    $params = array_merge($params, [$like, $like, $like, $like]);
}

$sql .= " ORDER BY created_at DESC LIMIT 100";
$st = $pdo->prepare($sql);
$st->execute($params);
$emails = $st->fetchAll();

$webhookUrl = mail_base_url() . '/mail/webhook.php';
$resendKey = get_resend_api_key();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox &bull; Resolute MRG Mail Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #090d16;
            --sidebar-bg: #0f172a;
            --card-bg: #1e293b;
            --border: #334155;
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --text-dim: #64748b;
            --hover-row: #1e293b;
            --unread-bg: #172554;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .sidebar-brand {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border);
        }
        .brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #fff;
        }
        .brand-title { font-size: 15px; font-weight: 700; color: #fff; }
        .brand-sub { font-size: 12px; color: var(--text-muted); }

        .compose-btn-wrap { padding: 18px 20px; }
        .btn-compose {
            width: 100%;
            padding: 12px 18px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            transition: all 0.15s;
        }
        .btn-compose:hover { background: var(--primary-hover); transform: translateY(-1px); }

        .nav-links { list-style: none; padding: 8px 12px; flex: 1; }
        .nav-item { margin-bottom: 4px; }
        .nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.15s;
        }
        .nav-link:hover { background: rgba(255,255,255,0.05); color: #fff; }
        .nav-link.active { background: rgba(59, 130, 246, 0.15); color: #60a5fa; font-weight: 600; }
        .nav-badge {
            background: #3b82f6;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 10px;
        }
        .nav-badge.zero { background: transparent; color: var(--text-dim); }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .user-info { font-size: 12px; color: var(--text-muted); overflow: hidden; text-overflow: ellipsis; }
        .user-email { font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .btn-logout { color: #f87171; text-decoration: none; font-size: 13px; font-weight: 600; }

        /* Main Content */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: var(--bg);
        }

        /* Top Header */
        .top-header {
            height: 64px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            background: var(--sidebar-bg);
            flex-shrink: 0;
        }
        .header-search {
            position: relative;
            width: 380px;
        }
        .header-search input {
            width: 100%;
            padding: 9px 14px 9px 36px;
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 8px;
            color: #fff;
            font-size: 13.5px;
            outline: none;
        }
        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 14px;
        }
        .header-actions { display: flex; gap: 10px; align-items: center; }
        .btn-pill {
            padding: 8px 14px;
            background: #1e293b;
            border: 1px solid var(--border);
            color: #cbd5e1;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .btn-pill:hover { background: #334155; color: #fff; }

        /* Alert Notifications */
        .flash-bar {
            padding: 12px 24px;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .flash-bar.success { background: rgba(16, 185, 129, 0.15); color: #6ee7b7; border-bottom: 1px solid #059669; }
        .flash-bar.error { background: rgba(239, 68, 68, 0.15); color: #fca5a5; border-bottom: 1px solid #dc2626; }

        /* Email List View */
        .email-list-pane {
            flex: 1;
            overflow-y: auto;
        }
        .email-row {
            display: flex;
            align-items: center;
            padding: 14px 24px;
            border-bottom: 1px solid #1e293b;
            cursor: pointer;
            transition: background 0.1s;
            position: relative;
        }
        .email-row:hover { background: var(--hover-row); }
        .email-row.is-unread { background: rgba(59, 130, 246, 0.08); font-weight: 600; }
        .email-row.is-unread::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary);
        }
        .star-col { width: 32px; color: var(--text-dim); cursor: pointer; font-size: 16px; }
        .star-col.active { color: #facc15; }
        .sender-col { width: 220px; font-size: 14px; color: #f1f5f9; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; padding-right: 16px; }
        .snippet-col { flex: 1; font-size: 13.5px; color: var(--text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .snippet-col strong { color: #f8fafc; font-weight: 600; }
        .date-col { width: 110px; text-align: right; font-size: 12.5px; color: var(--text-dim); }

        .empty-state {
            padding: 80px 24px;
            text-align: center;
            color: var(--text-muted);
        }
        .empty-icon { font-size: 48px; margin-bottom: 16px; opacity: 0.6; }

        /* Settings View */
        .settings-pane {
            flex: 1;
            overflow-y: auto;
            padding: 32px;
            max-width: 860px;
        }
        .settings-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }
        .settings-card h3 { font-size: 16px; margin-bottom: 8px; color: #fff; }
        .settings-card p { font-size: 13.5px; color: var(--text-muted); margin-bottom: 16px; line-height: 1.5; }
        .webhook-box {
            background: #0f172a;
            border: 1px solid #334155;
            padding: 12px 16px;
            border-radius: 8px;
            font-family: monospace;
            font-size: 13px;
            color: #38bdf8;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }
        .btn-copy {
            background: #1e293b;
            color: #fff;
            border: 1px solid #475569;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
        }
        .badge-verified {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.7);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 20px;
        }
        .modal-overlay.open { display: flex; }
        .modal-box {
            background: #0f172a;
            border: 1px solid var(--border);
            border-radius: 14px;
            width: 100%;
            max-width: 680px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.6);
        }
        .modal-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .modal-header h3 { font-size: 16px; font-weight: 700; color: #fff; }
        .btn-close {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 20px;
            cursor: pointer;
        }
        .modal-body {
            padding: 24px;
            overflow-y: auto;
            flex: 1;
        }
        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            background: #090d16;
        }
        .form-row { margin-bottom: 16px; }
        .form-row label { display: block; font-size: 13px; font-weight: 600; color: #cbd5e1; margin-bottom: 6px; }
        .form-row input, .form-row select, .form-row textarea {
            width: 100%;
            padding: 10px 14px;
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 8px;
            color: #fff;
            font-size: 13.5px;
            outline: none;
        }
        .form-row textarea { min-height: 180px; font-family: inherit; line-height: 1.5; resize: vertical; }

        .btn-action {
            padding: 10px 20px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13.5px;
            cursor: pointer;
        }
        .btn-action:hover { background: var(--primary-hover); }

        /* Read Email View Modal */
        .email-view-header {
            border-bottom: 1px solid var(--border);
            padding-bottom: 16px;
            margin-bottom: 20px;
        }
        .email-view-subject { font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 12px; }
        .email-meta-row { display: flex; justify-content: space-between; font-size: 13px; color: var(--text-muted); }
        .email-view-body {
            font-size: 14px;
            line-height: 1.7;
            color: #e2e8f0;
            background: #1e293b;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #334155;
            min-height: 200px;
            overflow-x: auto;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">&#9993;</div>
            <div>
                <div class="brand-title">Resolute MRG Mail</div>
                <div class="brand-sub">support@resolutemrg.com</div>
            </div>
        </div>

        <div class="compose-btn-wrap">
            <button class="btn-compose" onclick="openComposeModal()">
                <span>+</span> New Message
            </button>
        </div>

        <ul class="nav-links">
            <li class="nav-item">
                <a href="index.php?folder=inbox" class="nav-link <?= $folder === 'inbox' && $view !== 'settings' ? 'active' : '' ?>">
                    <span>📥 Inbox</span>
                    <span class="nav-badge <?= $counts['unread'] > 0 ? '' : 'zero' ?>"><?= $counts['unread'] ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?folder=sent" class="nav-link <?= $folder === 'sent' && $view !== 'settings' ? 'active' : '' ?>">
                    <span>📤 Sent</span>
                    <span class="nav-badge zero"><?= $counts['sent'] ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?folder=starred" class="nav-link <?= $folder === 'starred' && $view !== 'settings' ? 'active' : '' ?>">
                    <span>⭐ Starred</span>
                    <span class="nav-badge zero"><?= $counts['starred'] ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?folder=trash" class="nav-link <?= $folder === 'trash' && $view !== 'settings' ? 'active' : '' ?>">
                    <span>🗑 Trash</span>
                    <span class="nav-badge zero"><?= $counts['trash'] ?></span>
                </a>
            </li>
            <li class="nav-item" style="margin-top: 16px;">
                <a href="index.php?view=settings" class="nav-link <?= $view === 'settings' ? 'active' : '' ?>">
                    <span>⚙️ Settings &amp; Webhook</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-email"><?= htmlspecialchars($currentUser['email'] ?? 'support@resolutemrg.com') ?></div>
                <div>Connected to Resend</div>
            </div>
            <a href="index.php?logout=1" class="btn-logout" title="Log Out">Exit</a>
        </div>
    </aside>

    <!-- MAIN BODY -->
    <main class="main-wrapper">
        <!-- TOP HEADER -->
        <header class="top-header">
            <form method="GET" action="index.php" class="header-search">
                <input type="hidden" name="folder" value="<?= htmlspecialchars($folder) ?>">
                <span class="search-icon">🔍</span>
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search messages by sender, subject, content...">
            </form>

            <div class="header-actions">
                <button class="btn-pill" onclick="simulateInboundEmail()" title="Test receiving an email immediately">
                    <span>⚡ Simulate Inbound Test</span>
                </button>
                <a href="index.php?view=settings" class="btn-pill">
                    <span>⚙️ Webhook Setup</span>
                </a>
            </div>
        </header>

        <!-- FLASH NOTIFICATIONS -->
        <?php if (!empty($flash)): ?>
            <div class="flash-bar <?= htmlspecialchars($flash['type']) ?>">
                <span><?= htmlspecialchars($flash['message']) ?></span>
                <span style="cursor:pointer;" onclick="this.parentElement.style.display='none'">&times;</span>
            </div>
        <?php endif; ?>

        <!-- SETTINGS VIEW -->
        <?php if ($view === 'settings'): ?>
            <div class="settings-pane">
                <div class="settings-card">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <h3>📥 Resend Inbound Webhook (Receiving Emails)</h3>
                        <span class="badge-verified">Receiving Enabled</span>
                    </div>
                    <p>
                        To receive incoming emails sent to <strong>support@resolutemrg.com</strong> directly into this Inbox,
                        copy the URL below and add it to your <strong>Resend Dashboard &rarr; Webhooks</strong>:
                    </p>
                    <div class="webhook-box">
                        <span id="webhookUrlText"><?= htmlspecialchars($webhookUrl) ?></span>
                        <button class="btn-copy" onclick="copyWebhookUrl()">Copy URL</button>
                    </div>
                    <div style="font-size:12.5px; color:var(--text-muted); background:#0f172a; padding:12px 14px; border-radius:8px; border:1px solid #334155;">
                        <strong>Steps in Resend:</strong><br>
                        1. Go to <a href="https://resend.com/webhooks" target="_blank" style="color:#60a5fa;">resend.com/webhooks</a> &rarr; <strong>Add Webhook</strong>.<br>
                        2. Paste the URL: <code><?= htmlspecialchars($webhookUrl) ?></code><br>
                        3. In "Events", check <strong><code>email.received</code></strong>.<br>
                        4. Save. All incoming emails will instantly arrive in your Inbox!
                    </div>
                </div>

                <div class="settings-card">
                    <h3>📤 Resend API Configuration (Sending Emails)</h3>
                    <p>Current active key configured for <strong>resolutemrg.com</strong>:</p>
                    <form method="POST" action="index.php">
                        <input type="hidden" name="action" value="save_resend_key">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
                        <div class="form-row">
                            <label>Resend API Key</label>
                            <input type="password" name="resend_api_key" value="<?= htmlspecialchars($resendKey) ?>" style="font-family:monospace;">
                        </div>
                        <button type="submit" class="btn-action">Update Key</button>
                    </form>

                    <hr style="border:none; border-top:1px solid var(--border); margin: 24px 0;">

                    <h3>🩺 Dispatch Diagnostic Verification Test</h3>
                    <p>Send a real-time verification email from <code>support@resolutemrg.com</code> to verify sending delivery:</p>
                    <form method="POST" action="index.php" style="display:flex; gap:10px;">
                        <input type="hidden" name="action" value="test_diagnostic">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
                        <input type="email" name="test_to" placeholder="Enter recipient email..." required style="flex:1; padding:10px 14px; background:#1e293b; border:1px solid #334155; border-radius:8px; color:#fff;">
                        <button type="submit" class="btn-action">Send Test</button>
                    </form>
                </div>

                <div class="settings-card">
                    <h3>🔒 Security &amp; Password</h3>
                    <p>Update your mail portal access password:</p>
                    <form method="POST" action="index.php">
                        <input type="hidden" name="action" value="change_password">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
                        <div class="form-row">
                            <label>Current Password</label>
                            <input type="password" name="cur_password" required>
                        </div>
                        <div class="form-row">
                            <label>New Password (min 8 chars)</label>
                            <input type="password" name="new_password" required>
                        </div>
                        <div class="form-row">
                            <label>Confirm New Password</label>
                            <input type="password" name="new_password2" required>
                        </div>
                        <button type="submit" class="btn-action">Update Password</button>
                    </form>
                </div>
            </div>

        <!-- EMAIL LIST VIEW -->
        <?php else: ?>
            <div class="email-list-pane">
                <?php if (empty($emails)): ?>
                    <div class="empty-state">
                        <div class="empty-icon">&#128235;</div>
                        <h3>No messages in <?= htmlspecialchars(ucfirst($folder)) ?></h3>
                        <p style="margin-top:6px; font-size:13.5px;">
                            <?php if ($folder === 'inbox'): ?>
                                Inbound emails from clients will appear here automatically when received via Resend Webhook.
                            <?php else: ?>
                                Messages in this category will show up here.
                            <?php endif; ?>
                        </p>
                        <?php if ($folder === 'inbox'): ?>
                            <button class="btn-pill" style="margin: 20px auto 0; display:inline-flex;" onclick="simulateInboundEmail()">
                                ⚡ Send a Test Inbound Message
                            </button>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <?php foreach ($emails as $em): ?>
                        <div class="email-row <?= empty($em['is_read']) ? 'is-unread' : '' ?>" id="email-row-<?= $em['id'] ?>" onclick="viewEmail(<?= $em['id'] ?>)">
                            <div class="star-col <?= !empty($em['is_starred']) ? 'active' : '' ?>" onclick="event.stopPropagation(); toggleStar(<?= $em['id'] ?>)">
                                &#9733;
                            </div>
                            <div class="sender-col">
                                <?= htmlspecialchars($folder === 'sent' ? 'To: ' . $em['to_address'] : ($em['from_name'] ?: $em['from_address'])) ?>
                            </div>
                            <div class="snippet-col">
                                <strong><?= htmlspecialchars($em['subject'] ?: '(No Subject)') ?></strong> &mdash;
                                <span><?= htmlspecialchars($em['snippet'] ?: strip_tags($em['body_text'] ?: '')) ?></span>
                            </div>
                            <div class="date-col">
                                <?= date('M d, H:i', strtotime($em['created_at'])) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>

    <!-- COMPOSE MODAL -->
    <div class="modal-overlay" id="composeModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>New Message</h3>
                <button class="btn-close" onclick="closeComposeModal()">&times;</button>
            </div>
            <form method="POST" action="index.php">
                <input type="hidden" name="action" value="send_email">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">

                <div class="modal-body">
                    <div class="form-row">
                        <label>From</label>
                        <input type="text" value="Resolute MRG Support &lt;support@resolutemrg.com&gt;" readonly style="background:#090d16; color:#94a3b8;">
                    </div>
                    <div class="form-row">
                        <label>To (Recipient Email)</label>
                        <input type="email" name="to" id="composeTo" required placeholder="client@example.com">
                    </div>
                    <div class="form-row">
                        <label>Subject</label>
                        <input type="text" name="subject" id="composeSubject" required placeholder="Message Subject...">
                    </div>
                    <div class="form-row">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                            <label style="margin:0;">Templates</label>
                            <select onchange="applyTemplate(this.value)" style="width:auto; padding:4px 8px; font-size:12px;">
                                <option value="">Select a Quick Template...</option>
                                <option value="verification">Account Verification</option>
                                <option value="deposit">Deposit Received</option>
                                <option value="security">Security / 2FA Notice</option>
                                <option value="general">General Support Follow-up</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <label>Message Content</label>
                        <textarea name="body_html" id="composeBody" placeholder="Type your message here..."></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-pill" onclick="closeComposeModal()">Discard</button>
                    <button type="submit" class="btn-action">Send Message</button>
                </div>
            </form>
        </div>
    </div>

    <!-- VIEW EMAIL MODAL -->
    <div class="modal-overlay" id="viewEmailModal">
        <div class="modal-box" style="max-width: 780px;">
            <div class="modal-header">
                <h3 id="viewSubject">Message View</h3>
                <button class="btn-close" onclick="closeViewModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="email-view-header">
                    <div class="email-view-subject" id="viewSubjectHeading"></div>
                    <div class="email-meta-row">
                        <div>
                            <strong>From:</strong> <span id="viewFrom"></span><br>
                            <strong>To:</strong> <span id="viewTo"></span>
                        </div>
                        <div id="viewDate"></div>
                    </div>
                </div>
                <div class="email-view-body" id="viewBody"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-pill" onclick="replyCurrentEmail()">&#8617; Reply</button>
                <button type="button" class="btn-pill" onclick="deleteCurrentEmail()" style="color:#f87171;">Delete</button>
                <button type="button" class="btn-action" onclick="closeViewModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
        let currentEmailData = null;

        function copyWebhookUrl() {
            const url = document.getElementById('webhookUrlText').innerText;
            navigator.clipboard.writeText(url).then(() => {
                alert('Webhook URL copied to clipboard!\n\nPaste this in Resend Dashboard > Webhooks for event: email.received');
            });
        }

        function openComposeModal(to = '', subject = '', body = '') {
            document.getElementById('composeTo').value = to;
            document.getElementById('composeSubject').value = subject;
            document.getElementById('composeBody').value = body;
            document.getElementById('composeModal').classList.add('open');
        }

        function closeComposeModal() {
            document.getElementById('composeModal').classList.remove('open');
        }

        function closeViewModal() {
            document.getElementById('viewEmailModal').classList.remove('open');
        }

        async function viewEmail(id) {
            try {
                const res = await fetch(`api.php?action=get_email&id=${id}`);
                const data = await res.json();
                if (data.success && data.email) {
                    currentEmailData = data.email;
                    document.getElementById('viewSubject').innerText = data.email.subject || '(No Subject)';
                    document.getElementById('viewSubjectHeading').innerText = data.email.subject || '(No Subject)';
                    document.getElementById('viewFrom').innerText = `${data.email.from_name || ''} <${data.email.from_address}>`;
                    document.getElementById('viewTo').innerText = data.email.to_address;
                    document.getElementById('viewDate').innerText = data.email.created_at;

                    const bodyEl = document.getElementById('viewBody');
                    if (data.email.body_html) {
                        bodyEl.innerHTML = data.email.body_html;
                    } else {
                        bodyEl.innerText = data.email.body_text || '';
                    }

                    // Remove unread visual
                    const row = document.getElementById(`email-row-${id}`);
                    if (row) row.classList.remove('is-unread');

                    document.getElementById('viewEmailModal').classList.add('open');
                }
            } catch (e) {
                console.error(e);
            }
        }

        function replyCurrentEmail() {
            if (!currentEmailData) return;
            closeViewModal();
            const replyTo = currentEmailData.from_address;
            const replySubj = currentEmailData.subject.startsWith('Re:') ? currentEmailData.subject : 'Re: ' + currentEmailData.subject;
            const quote = `\n\n---------------- Original Message ----------------\nFrom: ${currentEmailData.from_address}\nDate: ${currentEmailData.created_at}\nSubject: ${currentEmailData.subject}\n\n${currentEmailData.body_text || ''}`;
            openComposeModal(replyTo, replySubj, quote);
        }

        async function deleteCurrentEmail() {
            if (!currentEmailData) return;
            if (confirm('Are you sure you want to delete this message?')) {
                const formData = new FormData();
                formData.append('id', currentEmailData.id);
                const res = await fetch('api.php?action=delete', { method: 'POST', body: formData });
                const d = await res.json();
                if (d.success) {
                    closeViewModal();
                    location.reload();
                }
            }
        }

        async function toggleStar(id) {
            const formData = new FormData();
            formData.append('id', id);
            await fetch('api.php?action=toggle_star', { method: 'POST', body: formData });
            location.reload();
        }

        async function simulateInboundEmail() {
            const sender = prompt("Enter simulated sender email:", "client.investor@gmail.com");
            if (!sender) return;
            const subject = prompt("Enter inquiry subject:", "Urgent: Resolute MRG Account Deposit Status");
            if (!subject) return;

            const formData = new FormData();
            formData.append('sender', sender);
            formData.append('sender_name', 'Client Investor');
            formData.append('subject', subject);
            formData.append('body', "Hello Support,\n\nI have submitted my transaction confirmation and would like to know the status.\n\nBest regards,\nClient");

            const res = await fetch('api.php?action=simulate_inbound', { method: 'POST', body: formData });
            const data = await res.json();
            if (data.success) {
                alert('Success! Simulated inbound email received.\nRefreshing inbox...');
                location.href = 'index.php?folder=inbox';
            }
        }

        function applyTemplate(type) {
            const body = document.getElementById('composeBody');
            const subj = document.getElementById('composeSubject');

            if (type === 'verification') {
                subj.value = 'Resolute MRG Hub &bull; Account Verification Confirmed';
                body.value = `<p>Dear Valued Client,</p><p>We are pleased to inform you that your identification verification for <strong>Resolute MRG Hub</strong> has been reviewed and successfully approved.</p><p>You now have unrestricted access to all features, including deposits, transfers, and high-yield savings plans.</p><p>Regards,<br>Resolute MRG Verification Team<br>support@resolutemrg.com</p>`;
            } else if (type === 'deposit') {
                subj.value = 'Resolute MRG Hub &bull; Deposit Confirmation';
                body.value = `<p>Hello,</p><p>We have received and credited your recent deposit to your Resolute MRG Hub balance.</p><p>You may log into your dashboard at any time to view your updated account ledger and active interest yields.</p><p>Best regards,<br>Resolute MRG Finance Desk<br>support@resolutemrg.com</p>`;
            } else if (type === 'security') {
                subj.value = 'Resolute MRG Hub &bull; Security & 2FA Alert';
                body.value = `<p>Hello,</p><p>This is an automated security notice regarding your account security settings. If you did not request any changes, please contact support immediately.</p><p>Stay safe,<br>Resolute MRG Security Operations<br>support@resolutemrg.com</p>`;
            } else if (type === 'general') {
                subj.value = 'Re: Resolute MRG Support Follow-up';
                body.value = `<p>Dear Client,</p><p>Thank you for reaching out to Resolute MRG Hub Support. We have received your inquiry and our team is actively assisting you.</p><p>If you have any further questions or require additional guidance, please do not hesitate to reply directly to this email.</p><p>Warm regards,<br>Resolute MRG Support Team<br>support@resolutemrg.com</p>`;
            }
        }
    </script>
</body>
</html>
