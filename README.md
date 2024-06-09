# Sistema de Cadastro de Reservas de Salas de Aula

## Descrição

## Tecnologias Utilizadas
- PHP 8
- Composer
- MySQL

## Postman
[Link](https://app.getpostman.com/join-team?invite_code=ceade3ccca6aafd05e148e412b8f5bef&target_code=f1ec94e150877067728285b121169ad1)


## 1. Usuários e Perfis

#### 1.1 Cadastro de Usuários

- **Todos** podem se cadastrar no sistema.
- Dados necessários para o cadastro:
  - `nome_usuario`
  - `login`
  - `senha`
- Campos adicionais definidos automaticamente:
  - `data_criacao` (data e hora do cadastro)
  - `perfil` (definido como `comum`)

#### 1.2 Login de Usuários

- **Todos** podem fazer login no sistema.
- Dados necessários para o login:
  - `login`
  - `senha`

#### 1.3 Criar, Buscar, Listar, Atualizar e Excluir Usuários
- **Todos Usuários recebem o tipo de perfil no token.
- **Apenas usuários com perfil `administrador_supremo`** podem realizar as seguintes operações:
  - Criar Usuario.
  - Listar todos os usuários.
  - Buscar usuários por ID.
  - Atualizar dados de usuários.
  - Excluir usuários.

## 2. Reservas

-----------------------------------

#### 2.1 Criação de Reservas

- **Todos** perfis podem criar reservas.
- Dados necessários para a criação de uma reserva:
  - `destinatario_reserva`
  - `observacao`
  - `horario_inicio`
  - `horario_fim`
  - `id_usuario` (ID do usuário que está fazendo a reserva)
  - `nome_sala`
- Campos adicionais definidos automaticamente:
  - `status` (definido inicialmente como `pendente`)

#### 2.2 Visualização e Edição de Reservas

- **Usuários com perfil `comum`** podem:
  - Visualizar suas próprias reservas.
  - Editar suas próprias reservas (mas não podem alterar o status da reserva).

#### 2.3 Status de Reservas

- **Usuários com perfil `administrador`** podem:
  - Alterar o status de uma reserva para `confirmada` ou `cancelada`.
  - Gerar relatórios de reservas.

#### 2.4 Operações Administrativas em Reservas

- **Usuários com perfil `administrador_supremo`** podem:
  - Criar reservas.
  - Listar todas as reservas.
  - Buscar reservas por ID.
  - Atualizar reservas.
  - Criar reservas.
  - Excluir reservas.

### 3. Especificações Técnicas

#### 3.1 Endpoints e Operações Permitidas

- **/usuarios**
  - `POST /usuarios/cadastrar`: Cadastro de novos usuários (acessível por todos).
  - `POST /usuarios/login`: Login de usuários (acessível por todos).
  - `GET /usuarios`: Listar todos os usuários (apenas `administrador_supremo`).
  - `GET /usuarios/{id}`: Buscar usuário por ID (apenas `administrador_supremo`).
  - `PUT /usuarios/{id}`: Atualizar dados de usuário (apenas `administrador_supremo`).
  - `DELETE /usuarios/{id}`: Excluir usuário (apenas `administrador_supremo`).

- **/reservas**
  - `POST /reservas/cadastrar`: Criar nova reserva (acessível por todos).
  - `GET /reservas`: Listar todas as reservas do usuário logado (acessível por todos).
  - `GET /reservas/{id}`: Buscar reserva por ID (acessível por todos).
  - `PUT /reservas/{id}`: Atualizar reserva (apenas pelo usuário que criou a reserva).
  - `DELETE /reservas/{id}`: Excluir reserva (apenas `administrador_supremo`).
  - `PATCH /reservas/{id}/status`: Alterar status da reserva (apenas `administrador`).

