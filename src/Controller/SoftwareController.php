<?php

namespace App\Controller;

use App\Model\Software;
use Exception;

class SoftwareController
{ 
    private $token;

    public function __construct()
    {
        $this->token = $this->getBearerToken();
    }

    private function getBearerToken(): string
    {
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $matches = [];
            if (preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
                return $matches[1];
            }
        }
        throw new Exception('Token não fornecido ou inválido');
    }

    private function validateToken(): void
    {
        // Validação do token (pode ser feita aqui ou em outro lugar centralizado)
    }

    public function selectAll(): array
    {
        $this->validateToken();
        $software = new Software();
        return $software->selectAll($this->token);
    }

    public function selectById(int $id): array
    {
        $this->validateToken();
        $software = new Software();
        return $software->selectById($id, $this->token);
    }

    public function cadastrar(int $id, string $nome_software, string $versao_software, string $descricao_software, float $preco_software): bool
    {
        $this->validateToken();
        $software = new Software();
        return $software->cadastrar($id, $nome_software, $versao_software, $descricao_software, $preco_software);
    }

    public function atualizar(int $id, string $nome_software, string $versao_software, string $descricao_software, float $preco_software): bool
    {
        $this->validateToken();
        $software = new Software();
        return $software->atualizar($id, $nome_software, $versao_software, $descricao_software, $preco_software);
    }

    public function excluir(int $id): bool
    {
        $this->validateToken();
        $software = new Software();
        return $software->excluir($id, $this->token);
    }
}
