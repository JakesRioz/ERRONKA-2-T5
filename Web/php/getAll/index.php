<?php
$host = 'localhost';
$db   = 'DATABASE POR NOMBRAR'; // Cambiar por el nombre de la base de datos
$user = 'root';
$pass = '';
$charset = 'utf8mb4';


// Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepared statements
];


try {
    // konexioa ezarri
    $pdo = new PDO($dsn, $user, $pass, $options);
    // idatzi select-a eta exekutatu
    $sql = "SELECT * FROM users"; //Cambiar users por el nombre de la tabla que se quiera consultar
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    // emaitza array baten sartu
    $datuak = $stmt->fetchAll();
   
    // HTTP goiburua idatzi JSON formatuan emateko erantzuna
    header('Content-Type: application/json; charset=utf-8');    
    // ez badago arazori, emaitza emango zaio JSON moduan.
    echo json_encode(['msg' => 'success','data' => $datuak], JSON_PRETTY_PRINT);
   
} catch (\PDOException $e) {
    // Handle connection or query errors
    http_response_code(500); // Set status code to 500 (Internal Server Error)
    // HTTP goiburua idatzi JSON formatuan emateko erantzuna
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'msg' => 'error',
        'data' => 0,
    ]);
    exit();
}
?>