# Sistema de Cadastro de Reservas de Salas de Aula

## Descrição


## Tecnologias Utilizadas
- PHP 8
- Composer
- MySQL

## Postman
[Postman de teste](https://app.getpostman.com/join-team?invite_code=ceade3ccca6aafd05e148e412b8f5bef&target_code=f1ec94e150877067728285b121169ad1)


## Rotas da API
Abaixo estão as rotas disponíveis no sistema e suas respectivas funcionalidades.

### `Usuarios.php`
- **POST /usuarios/login**
    - Descrição: Realiza o login do usuário e retorna um token JWT.
    - Exemplo de uso no Postman:
        - URL: `http://localhost:80/src/Router/Usuarios/login`
        - Método: POST
        - Body:
            ```json
            {
                "login": "joao",
                "senha": "123"
            }
            ```
        - Response:
            ```json
            {
                "success": "Login efetuado com sucesso",
                "token": "token aqui",
                "id": "`id`",
                "user": "`user`",
                "login": "`login`"
            }
            ```
- **POST /usuarios/cadastrar**
    - Descrição: Cadastra um novo usuário.
    - URL: `http://localhost:80/src/Router/Usuarios/cadastrar`
    - Método: POST
    - Body:
        ```json
        {
          "id":1,
          "nome":"José Neto",
          "login": "jose",
          "email":"jose@mail.com",
          "senha":"123"
        }
        ```
- **GET /usuarios**
    - Descrição: Retorna todos os usuários (necessita autenticação).
    - Headers:
        ```json
        {
            "Authorization": "Bearer seu-token-jwt-aqui"
        }
        ```
    - URL: `http://localhost:80/src/Router/Usuarios/`
    - Método: POST
    - Body:
        ```json
        {
          {},
          {},
          {}
        }
        ```
- **GET /usuarios/{id}**
    - Descrição: Retorna um usuário específico por ID (necessita autenticação).
    - Headers:
        ```json
        {
            "Authorization": "Bearer seu-token-jwt-aqui"
        }
        ```
    - URL: `http://localhost:80/src/Router/Usuarios/1`
    - Método: POST
    - Body:
        ```json
        {
          {}
        }
        ```
- **PUT /usuarios/{id}**
    - Descrição: Atualiza as informações de um usuário específico (necessita autenticação).
    - Headers:
        ```json
        {
            "Authorization": "Bearer seu-token-jwt-aqui"
        }
        ```
    - URL: `http://localhost:80/src/Router/Usuarios/1`
    - Método: POST
    - Body:
        ```json
        {
          {}
        }
        ```
- **DELETE /usuarios/{id}**
    - Descrição: Deleta um usuário específico (necessita autenticação).
    - Headers:
        ```json
        {
            "Authorization": "Bearer seu-token-jwt-aqui"
        }
        ```
    - URL: `http://localhost:80/src/Router/Usuarios/1`
    - Método: POST
    - Body:
        ```json
        {
          {}
        }
        ```

