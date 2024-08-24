<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "veterinaria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    echo "Conexión fallida";
    exit;
}

$userEmail = $_POST['userEmail'];
$userPassword = $_POST['userPassword'];

// Consultar usuario
$sql = "SELECT * FROM usuarios WHERE correo_electronico='$userEmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($userPassword, $row['contrasena'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_role'] = $row['rol']; // Obtener rol del usuario

        if ($row['rol'] == 'admin') {
            echo "admin";
        } else {
            echo "cliente";
        }
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "No se encontró el usuario";
}

$conn->close();
?>
