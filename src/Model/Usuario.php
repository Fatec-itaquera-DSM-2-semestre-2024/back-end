<?php

namespace App\Model;

use App\Database\Connection;
use Exception;

class Usuario
{

	function selectAll()
	{
		try {
			$db = new Connection();
			$sql = ' select * from usuarios';
			return $db->query($sql);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	function selectById($id)
	{

		try {
			$db = new Connection();

			$sql = ' select * from usuarios where id_usuario = "' . $id . '";';
			return $db->query($sql);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	function cadastrar($id, $nome, $login, $email, $senha)
	{
		try {
			$db = new Connection();
			$sql = 'insert into usuarios (id_usuario, nome_usuario, login, email, senha, criado) values ("' . $id . '","' . $nome . '","' . $login . '", "' . $email . '","' . $senha . '", now())';
			return $db->query_insert($sql);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	function login($login, $senha)
	{
		try {
			$db = new Connection();
			$sql = 'select * from usuarios where login = "' . $login . '" and senha = "' . $senha . '"';
			return $db->query($sql);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	function atualizar($id, $nome, $login, $email, $senha)
	{
		try {
			$db = new Connection();
			$sql = 'update usuarios set nome_usuario = "' . $nome . '", login = "' . $login . '", email = "' . $email . '", senha = "' . $senha . '", criado = NOW() where id_usuario = ' . $id;
			return $db->query_update($sql);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	function excluir($id)
	{
		try {
			$db = new Connection();
			$sql = 'delete from usuarios where id_usuario = ' . $id;
			return $db->query_update($sql);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
