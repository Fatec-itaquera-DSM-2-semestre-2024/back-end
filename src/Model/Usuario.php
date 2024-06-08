<?php

namespace App\Model;

use App\Database\Connection;
use Exception;
use Firebase\JWT\JWT;

class Usuario
{
    protected $id;
    protected $nome;
    protected $login;
    protected $email;
    protected $senha;
    private $secretKey = 'sua_chave_secreta'; // Troque isso por uma chave secreta forte

    function cadastrar($nome, $login, $email, $senha)
    {
        try {
            $db = new Connection();
            $sql = 'INSERT INTO usuarios (nome_usuario, login, email, senha) VALUES (:nome, :login, :email, :senha)';
            return $db->query_insert($sql, ['nome' => $nome, 'login' => $login, 'email' => $email, 'senha' => $senha]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

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
                        'login' => $user['login'],
                        'perfil' => $user['perfil']
                    ]
                ];
                $jwt = JWT::encode($payload, $this->secretKey, 'HS256');
                return ['success' => 'Login efetuado com sucesso', 'token' => $jwt, 'id' => $user['id_usuario'], 'user' => $user['nome_usuario'], 'login' => $user['login'], 'perfil' => $user['perfil']];
            } else {
                return ['error' => 'Login ou senha inválidos'];
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
