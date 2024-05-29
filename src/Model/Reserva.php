<?php

namespace App\Model;

use App\Database\Connection;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Reserva
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

    function selectAll($token)
    {
        try {
            $this->validateToken($token);
            $db = new Connection();
            $sql = 'SELECT * FROM reserva';
            return $db->query($sql);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function selectById($id, $token)
    {
        try {
            $this->validateToken($token);
            $db = new Connection();
            $sql = 'SELECT * FROM reserva WHERE id_reserva = :id';
            return $db->query($sql, ['id' => $id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function cadastrar($id, $destinatario, $observacao, $data, $horario_inicio, $horario_fim, $confirma, $id_sala, $id_usuario, $token)
    {
        try {
            $this->validateToken($token);
            $db = new Connection();
            $sql = 'INSERT INTO reserva (
                id_reserva, 
                destinatario_reserva, 
                observacao, 
                data_reserva, 
                horario_inicio, 
                horario_fim, 
                confirmada, 
                id_sala, 
                id_usuario
            ) VALUES (
                :id, 
                :destinatario, 
                :observacao, 
                :data, 
                :horario_inicio, 
                :horario_fim, 
                :confirma, 
                :id_sala, 
                :id_usuario
            )';
            return $db->query_insert($sql, [
                'id' => $id,
                'destinatario' => $destinatario,
                'observacao' => $observacao,
                'data' => $data,
                'horario_inicio' => $horario_inicio,
                'horario_fim' => $horario_fim,
                'confirma' => $confirma,
                'id_sala' => $id_sala,
                'id_usuario' => $id_usuario
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function atualizar($id, $destinatario, $observacao, $data, $horario_inicio, $horario_fim, $confirma, $id_sala, $id_usuario, $token)
    {
        try {
            $this->validateToken($token);
            $db = new Connection();
            $sql = 'UPDATE reserva SET 
                destinatario_reserva = :destinatario, 
                observacao = :observacao, 
                data_reserva = :data, 
                horario_inicio = :horario_inicio, 
                horario_fim = :horario_fim, 
                confirmada = :confirma, 
                id_sala = :id_sala, 
                id_usuario = :id_usuario 
                WHERE id_reserva = :id';
            return $db->query_update($sql, [
                'id' => $id,
                'destinatario' => $destinatario,
                'observacao' => $observacao,
                'data' => $data,
                'horario_inicio' => $horario_inicio,
                'horario_fim' => $horario_fim,
                'confirma' => $confirma,
                'id_sala' => $id_sala,
                'id_usuario' => $id_usuario
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function excluir($id, $token)
    {
        try {
            $this->validateToken($token);
            $db = new Connection();
            $sql = 'DELETE FROM reserva WHERE id_reserva = :id';
            return $db->query_delete($sql, ['id' => $id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}