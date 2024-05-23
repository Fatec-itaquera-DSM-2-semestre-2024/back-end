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
            $result = $db->query($sql);
            if($result){
                return $result;
            } else {
                return ['error' => 'Nenhum usuário encontrado'];
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function selectById($id)
    {
        try {
            $db = new Connection();
            $sql = 'SELECT * FROM usuarios WHERE id_usuario = :id';
            $result = $db->query($sql, ['id' => $id]);
            if($result){
                return $result[0];
            } else {
                return ['error' => 'Usuário não encontrado'];
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function cadastrar($id, $nome, $login, $email, $senha)
    {
        try {
            $db = new Connection();
            $sql = 'INSERT INTO usuarios (id_usuario, nome_usuario, login, email, senha, criado) VALUES (:id, :nome, :login, :email, :senha, NOW())';
            $result = $db->query_update($sql, ['id' => $id, 'nome' => $nome, 'login' => $login, 'email' => $email, 'senha' => $senha]);
            if ($result) {
                return ['success' => 'Usuário cadastrado com sucesso'];
            } else {
                return ['error' => 'Erro ao cadastrar usuário'];
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private $secretKey = 'Nossa_chave_ultra_secreta_hahaXD';

    function login($login, $senha)
    {
        try {
            $db = new Connection();
            $sql = 'SELECT * FROM usuarios WHERE login = :login AND senha = :senha';
            $result = $db->query($sql, ['login' => $login, 'senha' => $senha]);

            if (count($result) > 0) {
                $user = $result[0];
                $payload = [
                    'iss' => "localhost:80", 
                    'aud' => "fatec-itaquera.com",
                    'iat' => time(),
                    'nbf' => time(), 
                    'exp' => time() + (60 * 60),
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
            $result = $db->query_update($sql, ['id' => $id, 'nome' => $nome, 'login' => $login, 'email' => $email, 'senha' => $senha]);
            if ($result) {
                return ['success' => 'Usuário atualizado com sucesso'];
            } else {
                return ['error' => 'Erro ao atualizar usuário'];
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function excluir($id)
{
    try {
        $db = new Connection();
        $sql = 'DELETE FROM usuarios WHERE id_usuario = :id';
        $result = $db->query_update($sql, ['id' => $id]);
        
        if (is_bool($result)) {
            $affectedRows = 0;
        } else {
            $affectedRows = $result->rowCount();
        }
        if ($affectedRows > 0) {
            return ['success' => 'Usuário excluído com sucesso'];
        } else {
            return ['error' => 'Usuário não encontrado ou erro ao excluir'];
        }
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}

}
