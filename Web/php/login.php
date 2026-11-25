<?php
session_start();

$host = 'localhost';
$db   = 'eklipse_db'; // Cambiar por el nombre de la base de datos
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
    die("Error de conexión: " . $e->getMessage());
}

// 2. Recoger datos del formulario
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// 3. Consulta preparada para evitar inyección SQL
$stmt = $pdo->prepare("SELECT id, usuario, password FROM usuarios WHERE usuario = ?");
$stmt->execute([$usuario]);
$fila = $stmt->fetch();

// 4. Comprobar si existe el usuario y coincide la contraseña
if ($fila) {
    // Si en vuestra BD guardáis contraseñas en texto plano:
    if ($password === $fila['password']) { 
    // (Nota: si usáis password_hash(), cambia la línea de arriba por: if (password_verify($password, $fila['password'])) )
        $_SESSION['usuario'] = $fila['usuario'];
        header("Location: intranet.php");
        exit();
    }
}

// Si falla el usuario o la contraseña:
echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='login.html';</script>";

$pdo = null;
?>