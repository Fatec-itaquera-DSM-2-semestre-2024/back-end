<?php

namespace App\Controller;

use App\Model\Usuario;

class UsuarioController
{
    function selectAll()
    {
        $usuario = new Usuario();
        return $usuario->selectAll();
    }

    function selectById($id)
    {
        $usuario = new Usuario();
        return $usuario->selectById($id);
    }

    function cadastrar($id, $nome, $login, $email, $senha)
    {
        $usuario = new Usuario();
        return $usuario->cadastrar($id, $nome, $login, $email, $senha);
    }

    function login($login, $senha)
    {
        $usuario = new Usuario();
        return $usuario->login($login, $senha);
    }

    function atualizar($id, $nome, $login, $email, $senha)
    {
        $usuario = new Usuario();
        return $usuario->atualizar($id, $nome, $login, $email, $senha);
    }

    function excluir($id)
    {
        $usuario = new Usuario();
        return $usuario->excluir($id);
    }
}
