<?php
namespace App\Models;
use App\Config\Database;

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->pdo;
       
    }

    public function test(){
        $unbufferedResult =  $this->conn->query("SELECT nome FROM City");
        foreach ($unbufferedResult as $row) {
            echo $row['nome'] . PHP_EOL;
        }
    }

    public function create($nome, $senha) {
        $sql = "INSERT INTO users (nome, senha) VALUES ('$nome', '$senha')";
        return $this->conn->query($sql);
    }

    public function findByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}

$testeuser = new User();
$testeuser->test();
