<?php
namespace App\Controllers;
use App\Models\Reservation;

include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../config/jwt.php';

class ReservationController {

    public function index() {
        $reservation = new Reservation();
        $reservations = $reservation->getAll();
        include '../views/reservations/index.php';
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome_sala = $_POST['nome_sala'];
            $data = $_POST['data'];
            $hora_inicio = $_POST['hora_inicio'];
            $hora_fim = $_POST['hora_fim'];

            $reservation = new Reservation();
            $reservation->create($nome_sala, $data, $hora_inicio, $hora_fim);
            header("Location: /reservations");
        } else {
            include '../views/reservations/create.php';
        }
    }

    public function edit($id) {
        $reservation = new Reservation();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome_sala = $_POST['nome_sala'];
            $data = $_POST['data'];
            $hora_inicio = $_POST['hora_inicio'];
            $hora_fim = $_POST['hora_fim'];

            $reservation->update($id, $nome_sala, $data, $hora_inicio, $hora_fim);
            header("Location: /reservations");
        } else {
            $res = $reservation->findById($id);
            include '../views/reservations/edit.php';
        }
    }

    public function delete($id) {
        $reservation = new Reservation();
        $reservation->delete($id);
        header("Location: /reservations");
    }
}
?>
