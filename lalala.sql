CREATE DATABASE empresa;
USE empresa;

CREATE TABLE cliente (
`id_cliente` int NOT NULL AUTO_INCREMENT,
`nome` varchar(50) NOT NULL,
`endereco` varchar(20) NOT NULL,
`telefone` varchar(50) NOT NULL,
`email` varchar(50) NOT NULL,
PRIMARY KEY(`id_cliente`)
);

CREATE TABLE usuario(
`nome` varchar(50) DEFAULT NULL,
`usuario` varchar(10) DEFAULT NULL,
`senha` varchar(32) DEFAULT NULL,
`nivel` int DEFAULT NULL
);

INSERT INTO cliente (nome, endereco, telefone, email) VALUES
('João Silva', 'Rua A, 123', '(11) 1234-5678', 'joao.silva@email.com'),
('Maria Oliveira', 'Avenida B, 456', '(11) 8765-4321', 'maria.oliveira@email.com'),
('Carlos Souza', 'Rua C, 789', '(11) 5555-5555', 'carlos.souza@email.com'),
('Ana Pereira', 'Rua D, 321', '(11) 9999-9999', 'ana.pereira@email.com');

INSERT INTO usuario (nome, usuario, senha, nivel) VALUES
('Administrador', 'admin', 'admin123456', 1),
('Vendedor', 'vendedor01', 'senha123', 2),
('Suporte', 'suporte', 'suporte123', 3);

