<?php
session_start();
require 'db.php';
$errorea = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("CALL sp_erabiltzailea_egiaztatu(?)");
    $stmt->execute([trim($_POST['erabiltzailea'] ?? '')]);
    $user = $stmt->fetch();
    $stmt->closeCursor();
    if ($user && password_verify($_POST['pasahitza'] ?? '', $user['pasahitza_hash'])) {
        $_SESSION['erabiltzaile_id'] = $user['id'];
        $_SESSION['erabiltzailea'] = $user['erabiltzailea'];
        $_SESSION['izen_abizenak'] = $user['izen_abizenak'];
        header('Location: index.php');
        exit;
    }
    $errorea = 'Erabiltzailea edo pasahitza okerra da.';
}
?>
<!DOCTYPE html>
<html lang="eu">
<head><meta charset="UTF-8"><title>Eklipse Intranet - Saioa Hasi</title>
<style>
body{font-family:'Segoe UI',Arial,sans-serif;background:radial-gradient(circle at top,#2e1065 0%,#090412 70%);color:#f5f3ff;display:flex;justify-content:center;align-items:center;height:100vh;margin:0}
.card{background:rgba(24,12,46,0.85);backdrop-filter:blur(12px);padding:40px 35px;border:1px solid rgba(168,85,247,0.4);border-radius:16px;width:340px;box-shadow:0 0 40px rgba(126,34,206,0.45);text-align:center}
h2{margin:10px 0 5px;letter-spacing:3px;color:#fff;font-size:1.6em}
.sub{color:#f59e0b;font-size:0.75em;letter-spacing:4px;margin-bottom:25px}
input{width:100%;padding:12px 14px;margin:10px 0;border-radius:8px;border:1px solid #581c87;background:rgba(13,6,24,0.9);color:#fff;box-sizing:border-box;font-size:0.95em}
input:focus{outline:none;border-color:#c084fc;box-shadow:0 0 10px rgba(192,132,252,0.4))}
button{width:100%;padding:12px;margin-top:15px;background:linear-gradient(135deg,#7e22ce,#f59e0b);color:#fff;border:none;border-radius:8px;font-weight:bold;font-size:1em;cursor:pointer;transition:0.3s}
button:hoverzoom{opacity:0.92}
.err{background:rgba(239,68,68,0.15);border:1px solid #ef4444;color:#fca5a5;padding:10px;border-radius:8px;font-size:0.85em;margin-bottom:15px}
</style></head>
<body><div class="card">
<svg width="75" height="75" viewBox="0 0 100 100"><defs><filter id="g"><feGaussianBlur stdDeviation="3" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge></filter></defs><circle cx="50" cy="50" r="38" fill="#090412" stroke="#f59e0b" stroke-width="3" filter="url(#g)"/><path d="M 50 16 A 34 34 0 0 1 50 84 A 26 34 0 0 0 50 16 Z" fill="#fbbf24" opacity="0.9"/></svg>
<h2>EKLIPSE</h2><div class="sub">NIGHTCLUB | INTRANET</div>
<?php if ($errorea) echo "<div class='err'>$errorea</div>"; ?>
<form method="POST">
<input type="text" name="erabiltzailea" placeholder="Erabiltzailea" required>
<input type="password" name="pasahitza" placeholder="Pasahitza" required>
<button type="submit">Saioa hasi</button>
</form></div></body></html>
