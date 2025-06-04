CREATE DATABASE empresa;
USE empresa;

CREATE TABLE cliente (
pk_cliente int NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome_cliente varchar(50) NOT NULL,
endereco_cliente varchar(20) NOT NULL,
telefone_cliente varchar(50) NOT NULL,
email_cliente varchar(50) NOT NULL
);

CREATE TABLE usuario(
nome_usuario varchar(50) DEFAULT NULL,
pk_usuario varchar(10) DEFAULT NULL,
senha_usuario varchar(32) DEFAULT NULL,
nivel_usuario int DEFAULT NULL
);

INSERT INTO cliente (nome_cliente, endereco_cliente, telefone_cliente, email_cliente)
VALUES 
('João Silva', 'Rua das Flores, 123', '11999998888', 'joao@email.com'),
('Maria Oliveira', 'Av. Brasil, 456', '11988887777', 'maria@email.com'),
('Carlos Souza', 'Rua Central, 789', '11977776666', 'carlos@email.com');


INSERT INTO usuario (nome_usuario, pk_usuario, senha_usuario, nivel_usuario)
VALUES
('admin', 'USR001', 'senha123', 1),
('joaos', 'USR002', 'senha456', 2),
('mariao', 'USR003', 'senha789', 2);
