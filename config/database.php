<?php
$servername = "localhost";
$username = "root";
$password = "3264";
$dbname = "jwt_login";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
