<?php
session_start();
// Si alguien intenta entrar directo sin hacer login, lo echamos al index
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Intranet</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <span>Intranet - Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
        <a href="logout.php">Cerrar sesión</a>
    </header>
    <main>
        <h1>Panel Principal</h1>
        <p>Aquí se mostrarán los comentarios en el siguiente paso.</p>
    </main>
</body>
</html>