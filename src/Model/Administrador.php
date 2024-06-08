<?php

namespace App\Model;

use App\Database\Connection;
use Exception;

class Administrador extends Usuario
{

    function aprovarReserva($id_reserva)
    {
        try {
            $db = new Connection();
            $sql = 'UPDATE reservas SET status = :status WHERE id_reserva = :id_reserva';
            return $db->query_update($sql, ['id_reserva' => $id_reserva, 'status' => 'confirmada']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function cancelarReserva($id_reserva)
    {
        try {
            $db = new Connection();
            $sql = 'UPDATE reservas SET status = :status WHERE id_reserva = :id_reserva';
            return $db->query_update($sql, ['id_reserva' => $id_reserva, 'status' => 'cancelada']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function excluirReserva($id_reserva)
    {
        try {
            $db = new Connection();
            $sql = 'DELETE FROM reservas WHERE id_reserva = :id_reserva';
            return $db->query_update($sql, ['id_reserva' => $id_reserva]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function gerarRelatorios()
    {
        try {
            $db = new Connection();
            $sql = 'SELECT * FROM reservas';
            return $db->query($sql);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
