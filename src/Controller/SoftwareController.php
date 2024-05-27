<?php

namespace App\Controller;

use App\Model\Software;
use Exception;

/**
 * Classe SoftwareController
 * 
 * Esta classe é responsável por gerenciar as operações relacionadas ao software, como seleção,
 * criação, atualização e exclusão de registros. Ela utiliza tokens Bearer para autenticação.
 */
class SoftwareController
{ 
    /**
     * @var string $token O token Bearer para autenticação
     */
    private $token;

    /**
     * Construtor da classe SoftwareController.
     * Inicializa o token Bearer a partir dos cabeçalhos da requisição.
     * 
     * @throws Exception Se o token não for fornecido ou for inválido.
     */
    public function __construct()
    {
        $this->token = $this->getBearerToken();
    }

    /**
     * Obtém o token Bearer dos cabeçalhos da requisição.
     * 
     * @return string O token Bearer.
     * @throws Exception Se o token não for fornecido ou for inválido.
     */
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

    /**
     * Valida o token Bearer.
     * 
     * Esta função deve ser implementada para validar o token, verificando sua autenticidade,
     * validade, etc. No momento, ela está apenas como um placeholder.
     * 
     * @throws Exception Se a validação falhar.
     */
    private function validateToken(): void
    {
        // Validação do token (pode ser feita aqui ou em outro lugar centralizado)
        // Exemplo: verificar se o token está expirado, se é válido, etc.
    }

    /**
     * Seleciona todos os registros de software.
     * 
     * @return array Um array contendo todos os registros de software.
     * @throws Exception Se a validação do token falhar.
     */
    public function selectAll(): array
    {
        $this->validateToken();
        $software = new Software();
        return $software->selectAll($this->token);
    }

    /**
     * Seleciona um registro de software pelo seu ID.
     * 
     * @param int $id O ID do software a ser selecionado.
     * @return array Um array contendo os dados do software selecionado.
     * @throws Exception Se a validação do token falhar.
     */
    public function selectById(int $id): array
    {
        $this->validateToken();
        $software = new Software();
        return $software->selectById($id, $this->token);
    }

    /**
     * Cadastra um novo registro de software.
     * 
     * @param int $id O ID do novo software.
     * @param string $nome_software O nome do software.
     * @param string $versao_software A versão do software.
     * @param string $descricao_software A descrição do software.
     * @param float $preco_software O preço do software.
     * @return bool True se o cadastro for bem-sucedido, False caso contrário.
     * @throws Exception Se a validação do token falhar.
     */
    public function cadastrar(int $id, string $nome_software, string $versao_software, string $descricao_software, float $preco_software): bool
    {
        $this->validateToken();
        $software = new Software();
        return $software->cadastrar($id, $nome_software, $versao_software, $descricao_software, $preco_software);
    }

    /**
     * Atualiza um registro de software existente.
     * 
     * @param int $id O ID do software a ser atualizado.
     * @param string $nome_software O novo nome do software.
     * @param string $versao_software A nova versão do software.
     * @param string $descricao_software A nova descrição do software.
     * @param float $preco_software O novo preço do software.
     * @return bool True se a atualização for bem-sucedida, False caso contrário.
     * @throws Exception Se a validação do token falhar.
     */
    public function atualizar(int $id, string $nome_software, string $versao_software, string $descricao_software, float $preco_software): bool
    {
        $this->validateToken();
        $software = new Software();
        return $software->atualizar($id, $nome_software, $versao_software, $descricao_software, $preco_software);
    }

    /**
     * Exclui um registro de software pelo seu ID.
     * 
     * @param int $id O ID do software a ser excluído.
     * @return bool True se a exclusão for bem-sucedida, False caso contrário.
     * @throws Exception Se a validação do token falhar.
     */
    public function excluir(int $id): bool
    {
        $this->validateToken();
        $software = new Software();
        return $software->excluir($id, $this->token);
    }
}
