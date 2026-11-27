<?php
session_start();

// Si no ha hecho login, lo mandamos de vuelta a login.html
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

// Cargamos la vista HTML externa
require '..\index.html';
?>