<?php

namespace App\Controller;

use App\Model\Reserva;

class ReservaController
{
    function selectAll()
    {
        $usuario = new Reserva();
        return $usuario->selectAll();
    }

    function selectById($id)
    {
        $usuario = new Reserva();
        return $usuario->selectById($id);
    }

    function cadastrar($id, $destinatario, $observacao, $data, $horario_inicio, $horario_fim, $confirma, $id_sala, $id_usuario)
    {
        $usuario = new Reserva();
        return $usuario->cadastrar($id, $destinatario, $observacao, $data, $horario_inicio, $horario_fim, $confirma, $id_sala, $id_usuario);
    }

    function atualizar($id, $destinatario, $observacao, $data, $horario_inicio, $horario_fim, $confirma, $id_sala, $id_usuario)
    {
        $usuario = new Reserva();
        return $usuario->atualizar($id, $destinatario, $observacao, $data, $horario_inicio, $horario_fim, $confirma, $id_sala, $id_usuario);
    }

    function excluir($id)
    {
        $usuario = new Reserva();
        return $usuario->excluir($id);
    }
}
