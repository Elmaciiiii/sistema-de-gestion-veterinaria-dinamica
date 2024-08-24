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

$userName = $_POST['userName'];
$userEmail = $_POST['userEmail'];
$userPassword = $_POST['userPassword'];

// Validaciones en el servidor
if (strlen($userName) < 4) {
    echo "El nombre de usuario debe tener más de 4 caracteres.";
    exit;
}

if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
    echo "Correo electrónico no válido.";
    exit;
}

if (strlen($userPassword) < 8 || !preg_match('/[A-Z]/', $userPassword) || !preg_match('/\d/', $userPassword)) {
    echo "La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un número.";
    exit;
}

// Verificar si el correo electrónico o nombre de usuario ya están en uso
$sql = "SELECT * FROM usuarios WHERE correo_electronico='$userEmail' OR nombre_usuario='$userName'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "El nombre de usuario o el correo electrónico ya están en uso.";
    exit;
}

// Encriptar contraseña
$hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

// Insertar nuevo usuario
$sql = "INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena, rol) VALUES ('$userName', '$userEmail', '$hashedPassword', 'cliente')";
if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
