<?php
$pdo = new PDO("mysql:host=localhost;dbname=eklipse_intranet;charset=utf8mb4", "intranet_web", "WebEklipse2026!", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
