<?php session_start(); if(!isset($_SESSION['erabiltzaile_id'])){header('Location: saioa_hasi.php');exit;} ?>
<!DOCTYPE html><html lang="eu"><head><meta charset="UTF-8"><title>Eklipse Intranet</title><link rel="stylesheet" href="estilo.css"></head><body>
<header><div class="brand"><svg width="32" height="32" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="#090412" stroke="#f59e0b" stroke-width="5"/><path d="M50 16A34 34 0 0 1 50 84A26 34 0 0 0 50 16Z" fill="#fbbf24"/></svg><span>EKLIPSE <small>| Barne Ataria</small></span></div>
<nav><a href="index.php">Hasiera</a><a href="iruzkinak.php">Iruzkinak</a><a href="http://192.168.0.2/" target="_blank">GLPI Ticketing</a><a href="saioa_itxi.php" style="color:#fca5a5">Irten (<?=htmlspecialchars($_SESSION['erabiltzailea'])?>)</a></nav></header>
<div class="wrap"><div class="card"><h1>Ongi etorri, <?=htmlspecialchars($_SESSION['izen_abizenak'])?>!</h1><p>Eklipse Nightclub-eko langileen barne-sistemara sartu zara.</p></div>
<div class="grid"><div class="card"><h2>Barne Iruzkinak</h2><p>Lankideekin mezuak eta oharrak partekatu.</p><a class="btn" href="iruzkinak.php">Iruzkinak ikusi</a></div>
<div class="card"><h2>Laguntza (GLPI)</h2><p>Ekipo edo sare arazoen ticketak ireki.</p><a class="btn" href="http://192.168.0.2/" target="_blank">GLPI ireki</a></div></div></div></body></html>
