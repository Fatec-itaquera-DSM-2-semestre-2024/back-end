<?php

namespace App\Model;

use App\Database\Connection;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class UsuarioComum extends Usuario
{
    private $secretKey = 'sua_chave_secreta'; // Mesma chave secreta usada para gerar o token

    private function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return $decoded->data; // Retorna os dados do usuário do token
        } catch (Exception $e) {
            throw new Exception('Token inválido ou expirado');
        }
    }

    function visualizarReservas($token)
    {
        try {
            $decoded = $this->validateToken($token);
            $db = new Connection();
            $sql = 'SELECT * FROM reservas WHERE id_usuario = :id_usuario';
            return $db->query($sql, ['id_usuario' => $decoded->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function visualizarReserva($token, $id_reserva)
    {
        try {
            $decoded = $this->validateToken($token);
            $db = new Connection();
            $sql = 'SELECT * FROM reservas WHERE id_usuario = :id_usuario AND id_reserva = :id_reserva';
            return $db->query($sql, ['id_usuario' => $decoded->id, 'id_reserva' => $id_reserva]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function cadastrarReserva($token, $id_reserva, $destinatario, $observacao, $data, $horario_inicio, $horario_fim, $confirma, $id_sala, $id_usuario)
    {
        try {
            $decoded = $this->validateToken($token);
            $db = new Connection();
            $sql = 'INSERT INTO reservas (id_reserva, destinatario, observacao, data, horario_inicio, horario_fim, confirma, id_sala, id_usuario) VALUES (:id_reserva, :destinatario, :observacao, :data, :horario_inicio, :horario_fim, :confirma, :id_sala, :id_usuario)';
            return $db->query_insert($sql, ['id_reserva' => $id_reserva, 'destinatario' => $destinatario, 'observacao' => $observacao, 'data' => $data, 'horario_inicio' => $horario_inicio, 'horario_fim' => $horario_fim, 'confirma' => $confirma, 'id_sala' => $id_sala, 'id_usuario' => $id_usuario]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
