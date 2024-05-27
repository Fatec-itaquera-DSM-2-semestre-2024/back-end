<?php

namespace App\Model;

use App\Database\Connection;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Software
{
    private $secretKey = 'sua_chave_secreta'; // Mesma chave secreta usada para gerar o token

    private function validateToken(string $token): object
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return $decoded->data; // Retorna os dados do usuário do token
        } catch (Exception $e) {
            throw new Exception('Token inválido ou expirado');
        }
    }

    private function getConnection(): Connection
    {
        return new Connection();
    }

    public function selectAll(string $token): array
    {
        try {
            $this->validateToken($token);
            $db = $this->getConnection();
            $sql = 'SELECT * FROM software';
            return $db->query($sql);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function selectById(int $id, string $token): array
    {
        try {
            $this->validateToken($token);
            $db = $this->getConnection();
            $sql = 'SELECT * FROM software WHERE id_software = :id';
            return $db->query($sql, ['id' => $id]);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function cadastrar(int $id, string $nome_software, string $versao_software, string $descricao_software, float $preco_software, string $token): bool
    {
        try {
            $this->validateToken($token);
            $db = $this->getConnection();
            $sql = 'INSERT INTO software (
                id_software, 
                nome_software, 
                versao_software, 
                descricao_software, 
                preco_software
            ) VALUES (
                :id, 
                :nome_software, 
                :versao_software, 
                :descricao_software, 
                :preco_software
            )';
            return $db->query_insert($sql, [
                'id' => $id,
                'nome_software' => $nome_software,
                'versao_software' => $versao_software,
                'descricao_software' => $descricao_software,
                'preco_software' => $preco_software
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function atualizar(int $id, string $nome_software, string $versao_software, string $descricao_software, float $preco_software, string $token): bool
    {
        try {
            $this->validateToken($token);
            $db = $this->getConnection();
            $sql = 'UPDATE software SET 
                nome_software = :nome_software, 
                versao_software = :versao_software, 
                descricao_software = :descricao_software, 
                preco_software = :preco_software 
                WHERE id_software = :id';
            return $db->query_update($sql, [
                'id' => $id,
                'nome_software' => $nome_software,
                'versao_software' => $versao_software,
                'descricao_software' => $descricao_software,
                'preco_software' => $preco_software
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function excluir(int $id, string $token): bool
    {
        try {
            $this->validateToken($token);
            $db = $this->getConnection();
            $sql = 'DELETE FROM software WHERE id_software = :id';
            return $db->query_delete($sql, ['id' => $id]);
        } catch (Exception $e) {
            return false;
        }
    }
}
