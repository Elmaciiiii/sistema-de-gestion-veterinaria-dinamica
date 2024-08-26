<?php
session_start();

// Verificar si el usuario está logueado y si es un cliente
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "veterinaria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del usuario
$userId = $_SESSION['user_id'];
$sql = "SELECT nombre_usuario FROM usuarios WHERE id='$userId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre_usuario = $row['nombre_usuario'];
} else {
    $nombre_usuario = "Usuario";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria - Panel de Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        body.sweet-alert-show {
    overflow: hidden;
}


        .sidebar {
            width: 275px;
            background-color: #025162;
            color: #ecf0f1;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }

        .profile-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .sidebar h2 {
            font-size: 24px;
            color: #ecf0f1;
        }

        .sidebar a {
            display: block;
            width: 100%;
            padding: 15px 2px;
            color: #ecf0f1;
            text-decoration: none;
            font-size: 18px;
            text-align: center;
            border-bottom: 1px solid #34495e;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            color: #333;
            background: linear-gradient(to right, #0D8395, #017994);
            text-align: center;
        }

        h1 {
            margin-top: 0;
            color: #333;
        }

        .session-button {
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: goldenrod;
            color: #ecf0f1;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            border-radius: 4px;
            width: 80%;
            display: block;
        }

        .session-button.logout {
            background-color: #e74c3c;
        }

        .session-button.logout:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="profile-section">
        <img src="fotodeperfil.jpeg" alt="Foto de Usuario" class="profile-image">
        <h2>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?></h2>
    </div>
    <div>
        <a href="sacar_turno.php">Sacar Turno</a>
        <a href="ver_turnos.php">Ver Turnos</a>
        <a href="perfil.php">Gestionar Perfil</a>
        <a href="registrar_mascota.php">Añadir tus mascotas</a>
    </div>
    <!-- Botón de cierre de sesión con ID para JavaScript -->
    <a href="index.php" class="session-button logout" id="logout-button">Cerrar Sesión</a>
</div>

<div class="content">
    <h1>Bienvenido al Sistema de Gestión de la Veterinaria</h1>
    <p>Seleccione una opción del menú a la izquierda para comenzar.</p>
</div>

<!-- Incluye el archivo alertas.js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="alertas_clientes.js"></script>

</body>
</html>