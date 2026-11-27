<?php
session_start(); if(!isset($_SESSION['erabiltzaile_id'])){header('Location: saioa_hasi.php');exit;}
require 'db.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $s=$pdo->prepare("CALL sp_iruzkina_gehitu(?,?,?)");
    $s->execute([$_SESSION['erabiltzaile_id'],trim($_POST['izenburua']),trim($_POST['mezua'])]);
    $s->closeCursor(); header('Location: iruzkinak.php'); exit;
}
$s=$pdo->query("CALL sp_iruzkinak_lortu()"); $iruzkinak=$s->fetchAll(); $s->closeCursor();
?>
<!DOCTYPE html><html lang="eu"><head><meta charset="UTF-8"><title>Eklipse - Iruzkinak</title><link rel="stylesheet" href="estilo.css"></head><body>
<header><div class="brand"><svg width="32" height="32" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="#090412" stroke="#f59e0b" stroke-width="5"/><path d="M50 16A34 34 0 0 1 50 84A26 34 0 0 0 50 16Z" fill="#fbbf24"/></svg><span>EKLIPSE <small>| Barne Ataria</small></span></div>
<nav><a href="index.php">Hasiera</a><a href="iruzkinak.php">Iruzkinak</a><a href="http://192.168.0.2/" target="_blank">GLPI Ticketing</a><a href="saioa_itxi.php" style="color:#fca5a5">Irten (<?=htmlspecialchars($_SESSION['erabiltzailea'])?>)</a></nav></header>
<div class="wrap"><div class="card"><h2>Iruzkin berria</h2><form method="POST"><input type="text" name="izenburua" placeholder="Izenburua" required><textarea name="mezua" rows="3" placeholder="Idatzi hemen..." required></textarea><button class="btn" type="submit">Argitaratu</button></form></div>
<?php foreach($iruzkinak as $ir): ?><div class="card post"><h3><?=htmlspecialchars($ir['izenburua'])?></h3><div class="meta"><?=htmlspecialchars($ir['izen_abizenak'])?> | <?=htmlspecialchars($ir['argitaratze_data'])?></div><p><?=nl2br(htmlspecialchars($ir['mezua']))?></p></div><?php endforeach; ?></div></body></html>
