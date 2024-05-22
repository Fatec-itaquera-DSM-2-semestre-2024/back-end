<?php
namespace App\Model;

use App\Database\Connection;
use Exception;

class Reserva
{
 
    function selectAll()
    {
        try{
            $db = new Connection();
            $sql = ' select * from reserva';
            return $db->query($sql);
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }

	function selectById($id){
        try{
            $db = new Connection();
            $sql = ' select * from reserva where id_reserva = "'.$id.'";' ;
            return $db->query($sql);
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }		
	}
	
	function cadastrar($id, $destinatario, $observacao, $data, $horario_inicio, $horario_fim, $confirma, $id_sala, $id_usuario)
	{
		$db = new Connection();
		$sql = 'insert into reserva (
            id_reserva, 
            destinatario_reserva, 
            observacao, data_reserva, 
            horario_inicio, 
            horario_fim, 
            confirmada, 
            id_sala, 
            id_usuario) values (
                "'.$id.'",
                "'.$destinatario.'",
                "'.$observacao.'",
                "'.$data.'",
                "'.$horario_inicio.'",
                "'.$horario_fim.'",
                "'.$confirma.'",
                "'.$id_sala.'",
                "'.$id_usuario.'")';
		return $db->query_insert($sql);	
	}

    function atualizar($id, $destinatario, $observacao, $data, $horario_inicio, $horario_fim, $confirma, $id_sala, $id_usuario)
    {
        $db = new Connection();
        $sql = 'update reserva set 
            destinatario_reserva = "'.$destinatario.'",
            observacao = "'.$observacao.'",
            data_reserva = "'.$data.'",
            horario_inicio = "'.$horario_inicio.'",
            horario_fim = "'.$horario_fim.'",
            confirmada = "'.$confirma.'",
            id_sala = "'.$id_sala.'",
            id_usuario = "'.$id_usuario.'" where id_reserva = '.$id; 
        return $db->query_update($sql);
    }
	
	function excluir($id){
        $db = new Connection();
        $sql = 'delete from reserva where id_reserva = '.$id;
        return $db->query_delete($sql);
    }
	
}

?>