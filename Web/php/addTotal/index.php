<?php
header('Content-Type: application/json; charset=utf-8');

$host = 'localhost';
$db   = 'eklipse_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $eguna = $_POST['eguna'] ?? '';
    $dirua = $_POST['dirua'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO egunerokoa (eguna, dirua) VALUES (?, ?)");
    $stmt->execute([$eguna, $dirua]);

    echo json_encode(['msg' => 'success']);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['msg' => 'error']);
}

?>