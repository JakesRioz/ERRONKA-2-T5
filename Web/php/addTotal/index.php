<?php
$host = 'localhost';
$db   = 'NOMBRE DE LA BASE DE DATOS'; // Cambiar por el nombre de la base de datos
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
} catch (PDOException $e) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['msg' => 'Error de conexión: ' . $e->getMessage()]);
    exit;
}

$raw = stripslashes($_POST['param']);
$param = json_decode($raw);

$sql = "INSERT INTO users (id, username, password, company) VALUES (:id, :username, :password, :company)"; //POR EDITAR
$stmt = $pdo->prepare($sql);



$stmt->execute();

$rowsAffected = $stmt->rowCount();
if ($rowsAffected > 0) {
    $returnValue = ['msg' => "Success: Added $rowsAffected user(s)."];
    } else {
    $returnValue = ['msg' => "No user found with ID " . $param->id . " to delete."];} 

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($returnValue);