<?php
namespace App\Models;

include_once __DIR__ . '/../config/database.php';

class User {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function create($username, $password) {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        echo $sql;
        return $this->conn->query($sql);
    }

    public function findByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
}
?>
