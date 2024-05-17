<?php
namespace App\Models;

class Reservation {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAll() {
        $sql = "SELECT * FROM reservas";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($nome_sala, $data, $hora_inicio, $hora_fim) {
        $sql = "INSERT INTO reservas (nome_sala, data, hora_inicio, hora_fim) VALUES ('$nome_sala', '$data', '$hora_inicio', '$hora_fim')";
        return $this->conn->query($sql);
    }

    public function findById($id) {
        $sql = "SELECT * FROM reservas WHERE id = $id";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function update($id, $nome_sala, $data, $hora_inicio, $hora_fim) {
        $sql = "UPDATE reservas SET nome_sala='$nome_sala', data='$data', hora_inicio='$hora_inicio', hora_fim='$hora_fim' WHERE id=$id";
        return $this->conn->query($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM reservas WHERE id = $id";
        return $this->conn->query($sql);
    }
}
?>
