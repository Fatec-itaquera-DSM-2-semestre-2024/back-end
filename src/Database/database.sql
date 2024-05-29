create database fatec;

use fatec;

CREATE TABLE usuarios (
    id_usuario INTEGER PRIMARY KEY,
    nome_usuario VARCHAR(100),
    login VARCHAR(50),
    senha VARCHAR(100),
    email VARCHAR(100),
    criado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 

CREATE TABLE equipamentos(
    id_equipamento INTEGER PRIMARY KEY,
    nome_equipamento VARCHAR(144),
    descricao_equipamento VARCHAR(144),
    quantidade_equipamento INTEGER CHECK (quantidade_equipamento > 0)
 ); 


CREATE TABLE software (
    id_software INTEGER PRIMARY KEY,
    nome_software VARCHAR(100) ,
    versao_software VARCHAR(50),
    descricao_software VARCHAR(100),
    preco_software DECIMAL(10, 2) NULL 
);
 

CREATE TABLE equipamento_software (
    id_equipamento INT,
    id_software INT,
    PRIMARY KEY (id_equipamento, id_software),
    FOREIGN KEY (id_equipamento) REFERENCES equipamentos(id_equipamento),
    FOREIGN KEY (id_software) REFERENCES software(id_software)
);
 
 
CREATE TABLE sala(
    id_sala INTEGER PRIMARY KEY,
    numero_sala INTEGER,
    capacidade_sala INTEGER,
    id_equipamento INTEGER,
    FOREIGN KEY (id_equipamento) REFERENCES equipamentos(id_equipamento) -- ******CHECAR:  relacionamento atual permite que uma sala tenha apenas 1 equipamento, EG: 40 notebooks ou 40 computadores.***** --
 );


CREATE TABLE movimentacao_equipamentos (
     id_mov_equipamento INTEGER PRIMARY KEY,
     data_mov_equipamento TIMESTAMP,
     quantidade_mov_equipamento INTEGER,
     previsao_retorno_equipamento TIMESTAMP NULL,
     valor_manutencao REAL NULL,
     observacao_mov_equipamento VARCHAR(120) NULL,
     id_equipamento INTEGER,
     FOREIGN KEY (id_equipamento) REFERENCES equipamentos(id_equipamento)
 );


CREATE TABLE Reserva (
    id_reserva INTEGER PRIMARY KEY, 
    destinatario_reserva VARCHAR(120) NULL, 
    observacao VARCHAR(120) NULL,
    data_reserva DATE, 
    horario_inicio TIME, 
    horario_fim TIME, 
    confirmada TINYINT(1) DEFAULT 0 CHECK (confirmada IN (0, 1)), 
    id_sala INTEGER, 
    id_usuario INTEGER, 
    FOREIGN KEY (id_sala) REFERENCES sala(id_sala),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- Inserir valores na tabela usuarios
INSERT INTO usuarios (id_usuario, nome_usuario, login, senha, email) VALUES
(1, 'João Silva', 'joao', 'senha123', 'joao@example.com'),
(2, 'Maria Oliveira', 'maria', 'senha456', 'maria@example.com');

-- Inserir valores na tabela equipamentos
INSERT INTO equipamentos (id_equipamento, nome_equipamento, descricao_equipamento, quantidade_equipamento) VALUES
(1, 'Notebook', 'Notebook Dell Inspiron', 10),
(2, 'Projetor', 'Projetor Epson', 5);

-- Inserir valores na tabela software
INSERT INTO software (id_software, nome_software, versao_software, descricao_software, preco_software) VALUES
(1, 'Microsoft Office', '2019', 'Pacote Office completo', 299.99),
(2, 'Adobe Photoshop', '2021', 'Editor de imagens', 499.99);

-- Inserir valores na tabela equipamento_software
INSERT INTO equipamento_software (id_equipamento, id_software) VALUES
(1, 1),  -- Notebook com Microsoft Office
(1, 2),  -- Notebook com Adobe Photoshop
(2, 1);  -- Projetor com Microsoft Office

-- Inserir valores na tabela sala
INSERT INTO sala (id_sala, numero_sala, capacidade_sala, id_equipamento) VALUES
(1, 101, 20, 1),
(2, 102, 30, 2);

-- Inserir valores na tabela movimentacao_equipamentos
INSERT INTO movimentacao_equipamentos (id_mov_equipamento, data_mov_equipamento, quantidade_mov_equipamento, previsao_retorno_equipamento, valor_manutencao, observacao_mov_equipamento, id_equipamento) VALUES
(1, '2023-05-01 10:00:00', 2, '2023-05-10 10:00:00', 50.00, 'Manutenção preventiva', 1),
(2, '2023-05-02 11:00:00', 1, '2023-05-12 11:00:00', 30.00, 'Reparação do projetor', 2);

-- Inserir valores na tabela reserva
INSERT INTO reserva (id_reserva, destinatario_reserva, observacao, data_reserva, horario_inicio, horario_fim, confirmada, id_sala, id_usuario) VALUES
(1, 'Evento Corporativo', 'Reserva para reunião', '2023-05-15', '09:00', '12:00', 1, 1, 1),
(2, 'Treinamento', 'Treinamento de novos funcionários', '2023-05-16', '13:00', '17:00', 0, 2, 2);

