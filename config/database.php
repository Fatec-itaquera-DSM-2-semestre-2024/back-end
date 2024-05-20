<?php
namespace App\Config;

$servername = "127.0.0.1";
$username = "duno";
$password = "3264";
$dbname = "fatec";

$pdo = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

$unbufferedResult = $pdo->query("SELECT nome FROM City");
foreach ($unbufferedResult as $row) {
    echo $row['nome'] . PHP_EOL;
}


?>
