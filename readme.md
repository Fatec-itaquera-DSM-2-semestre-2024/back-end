Backend do projeto Interdisciplinar do curso Desenvolvimento de Software Multiplataforma da Fatec Itaquera

Casos de Uso:

Professor:Agendar Laboratório, Cancelar Reserva, Visualizar Reservas, Visualizar Disponibilidade de Equipamentos e Softwares, 
Auxiliar Docente:Gerenciar Reservas, Liberar Reservas, Gerar Relatórios de Uso

Coordenador:Resolver Conflitos de Agenda, Autorizar Reservas Excepcionais

Laboratório:
Nome, Localização, Equipamentos, Softwares, Disponibilidade, 
Reserva:Data, Horário, Professor, Laboratório, Status (pendente, confirmada, cancelada)

Professor:Nome, Email, Curso, Disciplina, Auxiliar 
Docente: Nome, Email, Laboratório

Coordenador:Nome, Email

Relacionamentos:
Professor faz Reserva, Laboratório tem Reserva, Auxiliar Docente gerencia Reserva, Coordenador resolve Conflito de Agenda, Coordenador autoriza Reserva Excepcional

Atributos:
Nome, Email, Data, Horário, Laboratório, Equipamentos, Softwares, Disponibilidade, Status

Métodos:
Agendar Laboratório, Cancelar Reserva, Visualizar Reservas, Visualizar Disponibilidade de Equipamentos e Softwares, Gerenciar Reservas, Liberar Reservas, 
Gerar Relatórios de Uso, Resolver Conflitos de Agenda, Autorizar Reservas Excepcionais

Observações:
O diagrama UML representa uma visão geral do sistema, Os detalhes do sistema podem ser modificados de acordo com as necessidades específicas.

Diagrama:

UseCase: Professor

  * Agendar Laboratório
  * Cancelar Reserva
  * Visualizar Reservas
  * Visualizar Disponibilidade de Equipamentos e Softwares

UseCase: Auxiliar Docente

  * Gerenciar Reservas
  * Liberar Reservas
  * Gerar Relatórios de Uso

UseCase: Coordenador

  * Resolver Conflitos de Agenda
  * Autorizar Reservas Excepcionais

Class: Laboratório

  * Nome
  * Localização
  * Equipamentos
  * Softwares
  * Disponibilidade

Class: Reserva

  * Data
  * Horário
  * Professor
  * Laboratório
  * Status (pendente, confirmada, cancelada)

Class: Professor

  * Nome
  * Email
  * Curso
  * Disciplina

Class: Auxiliar Docente

  * Nome
  * Email
  * Laboratório

Class: Coordenador

  * Nome
  * Email

Professor ---- Reserva
Laboratório ---- Reserva
Auxiliar Docente ---- Reserva
Coordenador ---- Conflito de Agenda
Coordenador ---- Reserva Excepcional
Legenda:

UseCase: Representa um conjunto de ações realizadas por um usuário para atingir um objetivo específico.
Class: Representa um conjunto de objetos com características e comportamentos semelhantes.
Relacionamento: Representa a associação entre duas classes.
Atributo: Representa uma característica de um objeto.
Método: Representa um comportamento de um objeto.



### Requisitos mínimos do sistema

1. **Autenticação e Autorização**:
    - Os usuários devem ser capazes de se autenticar (fazer login) no sistema.
    - Implemente um sistema de permissões para controlar o acesso a diferentes funcionalidades (por exemplo, apenas administradores podem gerenciar laboratórios).

2. **Agendamento de Laboratórios**:
    - Os usuários devem poder visualizar a disponibilidade dos laboratórios.
    - Permita que os usuários reservem um laboratório para um horário específico.

3. **Gerenciamento de Reservas**:
    - Os usuários devem poder visualizar suas reservas existentes.
    - Implemente a capacidade de cancelar ou modificar reservas.

4. **Notificações**:
    - Envie notificações por e-mail ou mensagens para os usuários sobre suas reservas.
    - Notifique os administradores sobre novas reservas ou alterações.

5. **Relatórios e Estatísticas**:
    - Gere relatórios sobre o uso dos laboratórios (por exemplo, quantas reservas foram feitas em um mês).
    - Forneça estatísticas sobre a ocupação dos laboratórios.

6. **Interface do Usuário Amigável**:
    - Crie uma interface intuitiva e fácil de usar para os usuários.
    - Considere a usabilidade em dispositivos móveis.

7. **Segurança**:
    - Proteja os dados dos usuários.
    - Evite vulnerabilidades comuns, como injeção de SQL ou ataques de cross-site scripting (XSS).

8. **Configuração do Banco de Dados**:
    - Configure um banco de dados para armazenar informações sobre laboratórios, reservas e usuários.

9. **Testes**:
    - Realize testes rigorosos para garantir que o sistema funcione corretamente.
    - Teste casos de uso comuns, como agendar, cancelar e visualizar reservas.


