<?php
//Estilo de procedimientos

$post = "localhost";
$user = "root";
$pass = "";
$db = "reread.php";

//Crear la conexión
$conn = mysqli_connect($host, $user, $pass, $db);

//Checkear la connexión
if (!$conn) {
    echo "Erorr: no se pudo conectar a Mysql." . PHP_EQL;
    echo "Error de depuración: " . mysqli_connect_errno() . PHP,EQL;
    exit;
} else {
    mysqli_connect_charset($conn, "utf8");
}
?>