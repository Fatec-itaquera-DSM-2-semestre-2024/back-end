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
