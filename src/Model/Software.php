<?php
namespace App\Model;
class Software {
    private int $id;
    private string $nome_software;
    private string $versao_software;
    private string $descricao_software;
    private float $preco_software;

    public function __construct(){
        $this->id = Uuid::uuid4()->toString();
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function getNomeSoftware() {
        return $this->nome_software;
    }

    public function setNomeSoftware($nome_software) {
        $this->nome_software = $nome_software;
    }
    public function getVersaoSoftware() {
        return $this->versao_software;
    }

    public function setVersaoSoftware($versao_software) {
        $this->versao_software = $versao_software;
    }
    public function getDescricaoSoftware() {
        return $this->descricao_software;
    }

    public function setDescricaoSoftware($descricao_software) {
        $this->descricao_software = $descricao_software;
    }
    public function getPrecoSoftware() {
        return $this->preco_software;
    }

    public function setPrecoSoftware($preco_software) {
        $this->preco_software = $preco_software;
    }
    public function toArray() {
        return [
            'id' => $this->getId(),
            'nome_software' => $this->getNomeSoftware(),
            'versao_software' => $this->getVersaoSoftware(),
            'descricao_software' => $this->getDescricaoSoftware(),
            'preco_software' => $this->getPrecoSoftware()
        ];
    }
}
