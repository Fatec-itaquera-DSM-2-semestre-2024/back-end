<?php

namespace App\Model;
use Ramsey\Uuid\Uuid;

class Salas {
    private $id;
    private int $numerosala;
    private int $capacidadesala;
    private int $ativo;
    private string $sala= 'salas';
  
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
    
    public function getSala(): string
    {
        return $this->sala;
    }
    public function getId(): string
    {
        return $this->id;
    }
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function getNumerosala(): int
    {
        return $this->numerosala;
    }
    public function setNumerosala(int $numerosala): self
    {
        $this->numerosala = $numerosala;

        return $this;
    }
    
    public function getCapacidadesala(): int
    {
        return $this->capacidadesala;
    }
    public function setCapacidadesala(int $capacidadesala): self
    {
        $this->capacidadesala = $capacidadesala;

        return $this;
    }
    public function getAtivo(): int
    {
        return $this->ativo;
    }
    public function setAtivo(int $ativo): self
    {
        $this->ativo = $ativo;

        return $this;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'numerosala' => $this->numerosala,
            'capacidadesala' => $this->capacidadesala,
            'ativo' => $this->ativo
        ];
    }
}
