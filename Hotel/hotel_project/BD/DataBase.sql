Create DATABASE Hotel;

use Hotel;

/*
	Criação do Script Base de Dados Bat Hotel
    Criação das tabelas (conta, funcionario, quarto e reservas),
    com referências entre elas
*/


-- 1. Criar a tabela Conta
CREATE TABLE Conta (
    id int AUTO_INCREMENT,
    nome VARCHAR(50),
    email VARCHAR(50),
    password VARCHAR(64),
    Data_criacao DATE,
    status VARCHAR(30),
    PRIMARY KEY (id, email)
);

-- 2. Criar a tabela Funcionario
CREATE TABLE Funcionario (
    id int AUTO_INCREMENT,
    nome VARCHAR(50),
    email VARCHAR(50),
    telemovel VARCHAR(13),
    Morada VARCHAR(50),
    Data_criacao DATE,
    Cargo VARCHAR(30),
    PRIMARY KEY (id, email)
);

-- 3. Criar a tabela Quarto
CREATE TABLE Quarto (
    id int AUTO_INCREMENT,
    piso int,
    tipo_quarto VARCHAR(20),
    descricao TEXT,
    status VARCHAR(15),
    img_quarto VARCHAR(100), -- Caminho da Imagem do Quarto especificado
    PRIMARY KEY (id)
);

-- 4. Criar a tabela Reserva (que depende de Quarto)
CREATE TABLE Reserva (
    id int AUTO_INCREMENT,
    nome VARCHAR(50),
    email VARCHAR(50),
    nif VARCHAR(9),
    telemovel VARCHAR(13),
    id_quarto int,
    piso int,
    tipo_quarto varchar(20),
    tipo_pagamento VARCHAR(30), -- MB WAY / Multibanco / Paypal / Dinheiro Vivo
    valor DECIMAL(6,2),
    estadia int,
    status VARCHAR(20), -- (Check-in / Check-out)
    
    PRIMARY KEY (id, email),
   
    FOREIGN KEY (id_quarto) REFERENCES Quarto(id)
);
