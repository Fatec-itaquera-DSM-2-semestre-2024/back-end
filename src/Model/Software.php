<?php

namespace App\Model;

use App\Database\Connection;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Classe Software
 * 
 * Esta classe é responsável por gerenciar as operações de banco de dados relacionadas ao software.
 * Ela também valida os tokens JWT para garantir que apenas usuários autenticados possam realizar operações.
 */
class Software
{
    /**
     * @var string $secretKey A chave secreta usada para gerar e validar os tokens JWT
     */
    private $secretKey = 'sua_chave_secreta'; // Mesma chave secreta usada para gerar o token

    /**
     * Valida o token JWT.
     * 
     * @param string $token O token JWT a ser validado.
     * @return object Os dados do usuário contidos no token.
     * @throws Exception Se o token for inválido ou expirado.
     */
    private function validateToken(string $token): object
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return $decoded->data; // Retorna os dados do usuário do token
        } catch (Exception $e) {
            throw new Exception('Token inválido ou expirado');
        }
    }

    /**
     * Obtém uma conexão com o banco de dados.
     * 
     * @return Connection A conexão com o banco de dados.
     */
    private function getConnection(): Connection
    {
        return new Connection();
    }

    /**
     * Seleciona todos os registros de software.
     * 
     * @param string $token O token JWT para autenticação.
     * @return array Um array contendo todos os registros de software.
     * @throws Exception Se a validação do token falhar.
     */
    public function selectAll(string $token): array
    {
        try {
            $this->validateToken($token);
            $db = $this->getConnection();
            $sql = 'SELECT * FROM software';
            return $db->query($sql);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Seleciona um registro de software pelo seu ID.
     * 
     * @param int $id O ID do software a ser selecionado.
     * @param string $token O token JWT para autenticação.
     * @return array Um array contendo os dados do software selecionado.
     * @throws Exception Se a validação do token falhar.
     */
    public function selectById(int $id, string $token): array
    {
        try {
            $this->validateToken($token);
            $db = $this->getConnection();
            $sql = 'SELECT * FROM software WHERE id_software = :id';
            return $db->query($sql, ['id' => $id]);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Cadastra um novo registro de software.
     * 
     * @param int $id O ID do novo software.
     * @param string $nome_software O nome do software.
     * @param string $versao_software A versão do software.
     * @param string $descricao_software A descrição do software.
     * @param float $preco_software O preço do software.
     * @param string $token O token JWT para autenticação.
     * @return bool True se o cadastro for bem-sucedido, False caso contrário.
     * @throws Exception Se a validação do token falhar.
     */
    public function cadastrar(int $id, string $nome_software, string $versao_software, string $descricao_software, float $preco_software, string $token): bool
    {
        try {
            $this->validateToken($token);
            $db = $this->getConnection();
            $sql = 'INSERT INTO software (
                id_software, 
                nome_software, 
                versao_software, 
                descricao_software, 
                preco_software
            ) VALUES (
                :id, 
                :nome_software, 
                :versao_software, 
                :descricao_software, 
                :preco_software
            )';
            return $db->query_insert($sql, [
                'id' => $id,
                'nome_software' => $nome_software,
                'versao_software' => $versao_software,
                'descricao_software' => $descricao_software,
                'preco_software' => $preco_software
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Atualiza um registro de software existente.
     * 
     * @param int $id O ID do software a ser atualizado.
     * @param string $nome_software O novo nome do software.
     * @param string $versao_software A nova versão do software.
     * @param string $descricao_software A nova descrição do software.
     * @param float $preco_software O novo preço do software.
     * @param string $token O token JWT para autenticação.
     * @return bool True se a atualização for bem-sucedida, False caso contrário.
     * @throws Exception Se a validação do token falhar.
     */
    public function atualizar(int $id, string $nome_software, string $versao_software, string $descricao_software, float $preco_software, string $token): bool
    {
        try {
            $this->validateToken($token);
            $db = $this->getConnection();
            $sql = 'UPDATE software SET 
                nome_software = :nome_software, 
                versao_software = :versao_software, 
                descricao_software = :descricao_software, 
                preco_software = :preco_software 
                WHERE id_software = :id';
            return $db->query_update($sql, [
                'id' => $id,
                'nome_software' => $nome_software,
                'versao_software' => $versao_software,
                'descricao_software' => $descricao_software,
                'preco_software' => $preco_software
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Exclui um registro de software pelo seu ID.
     * 
     * @param int $id O ID do software a ser excluído.
     * @param string $token O token JWT para autenticação.
     * @return bool True se a exclusão for bem-sucedida, False caso contrário.
     * @throws Exception Se a validação do token falhar.
     */
    public function excluir(int $id, string $token): bool
    {
        try {
            $this->validateToken($token);
            $db = $this->getConnection();
            $sql = 'DELETE FROM software WHERE id_software = :id';
            return $db->query_delete($sql, ['id' => $id]);
        } catch (Exception $e) {
            return false;
        }
    }
}
