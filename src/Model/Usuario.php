<?php

namespace App\Model;

use App\Database\Connection;
use Exception;
use Firebase\JWT\JWT;

class Usuario
{

    function selectAll()
    {
        try {
            $db = new Connection();
            $sql = 'SELECT * FROM usuarios';
            return $db->query($sql);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function selectById($id)
    {
        try {
            $db = new Connection();
            $sql = 'SELECT * FROM usuarios WHERE id_usuario = :id';
            return $db->query($sql, ['id' => $id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function cadastrar($id, $nome, $login, $email, $senha)
    {
        try {
            $db = new Connection();
            $sql = 'INSERT INTO usuarios (id_usuario, nome_usuario, login, email, senha, criado) VALUES (:id, :nome, :login, :email, :senha, NOW())';
            return $db->query_insert($sql, ['id' => $id, 'nome' => $nome, 'login' => $login, 'email' => $email, 'senha' => $senha]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private $secretKey = 'sua_chave_secreta'; // Troque isso por uma chave secreta forte

    function login($login, $senha)
    {
        try {
            $db = new Connection();
            $sql = 'SELECT * FROM usuarios WHERE login = :login AND senha = :senha';
            $result = $db->query($sql, ['login' => $login, 'senha' => $senha]);

            if (count($result) > 0) {
                $user = $result[0];
                $payload = [
                    'iss' => "localhost:80", // Issuer
                    'aud' => "fatec-itaquera.com", // Audience
                    'iat' => time(), // Issued at
                    'nbf' => time(), // Not before
                    'exp' => time() + (60 * 60), // Expiration time (1 hour)
                    'data' => [
                        'id' => $user['id_usuario'],
                        'login' => $user['login']
                    ]
                ];
                $jwt = JWT::encode($payload, $this->secretKey, 'HS256');
                return ['success' => 'Login efetuado com sucesso', 'token' => $jwt, 'id' => $user['id_usuario'], 'user' => $user['nome_usuario'],'login' => $user['login']];
            } else {
                return ['error' => 'Login ou senha inválidos'];
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function atualizar($id, $nome, $login, $email, $senha)
    {
        try {
            $db = new Connection();
            $sql = 'UPDATE usuarios SET nome_usuario = :nome, login = :login, email = :email, senha = :senha, criado = NOW() WHERE id_usuario = :id';
            return $db->query_update($sql, ['id' => $id, 'nome' => $nome, 'login' => $login, 'email' => $email, 'senha' => $senha]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function excluir($id)
    {
        try {
            $db = new Connection();
            $sql = 'DELETE FROM usuarios WHERE id_usuario = :id';
            return $db->query_update($sql, ['id' => $id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}