<?php
session_start();

// 1. Conexión a la base de datos (datos típicos de XAMPP/WAMP)
$conexion = new mysqli("localhost", "root", "", "nombre_de_tu_bd");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// 2. Recoger datos del formulario
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// 3. Consulta preparada para evitar inyección SQL
$stmt = $conexion->prepare("SELECT id, usuario, password FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

// 4. Comprobar si existe el usuario y coincide la contraseña
if ($fila = $resultado->fetch_assoc()) {
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

$stmt->close();
$conexion->close();
?>