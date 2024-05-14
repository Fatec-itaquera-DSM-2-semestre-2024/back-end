<?php
namespace App\Model;
class Reserva {
    private int $id;
    private string $destinatario_reserva;
    private string $observacao_reserva;
    private string $data_reserva;
    private string $horario_inicio;
    private string $horario_fim;
    private int $confirmada_reserva;
    private int $id_usuario;
    public $conn;

    public function __construct() {
        $this->conn = new Model();
        $this->conn->createTableFromModel($this);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDestinatarioReserva() {
        return $this->destinatario_reserva;
    }

    public function setDestinatarioReserva($destinatario_reserva) {
        $this->destinatario_reserva = $destinatario_reserva;
    }

    public function getObservacaoReserva() {
        return $this->observacao_reserva;
    }

    public function setObservacaoReserva($observacao_reserva) {
        $this->observacao_reserva = $observacao_reserva;
    }

    public function getDataReserva() {
        return $this->data_reserva;
    }

    public function setDataReserva($data_reserva) {
        $this->data_reserva = $data_reserva;
    }

    public function getHorarioInicio() {
        return $this->horario_inicio;
    }

    public function setHorarioInicio($horario_inicio) {
        $this->horario_inicio = $horario_inicio;
    }

    public function getHorarioFim() {
        return $this->horario_fim;
    }

    public function setHorarioFim($horario_fim) {
        $this->horario_fim = $horario_fim;
    }

    public function getConfirmadaReserva() {
        return $this->confirmada_reserva;
    }

    public function setConfirmadaReserva($confirmada_reserva) {
        $this->confirmada_reserva = $confirmada_reserva;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    
    public function getType() {
        return 'User';
    }

    public function toArray() {
        return [
            'id' => $this->getId(),
            'destinatario_reserva' => $this->getDestinatarioReserva(),
            'observacao_reserva' => $this->getObservacaoReserva(),
            'data_reserva' => $this->getDataReserva(),
            'horario_inicio' => $this->getHorarioInicio(),
            'horario_fim' => $this->getHorarioFim(),
            'confirmada_reserva' => $this->getConfirmadaReserva(),
            'id_usuario' => $this->getIdUsuario(),
            'type' => $this->getType()
        ];
    }
}