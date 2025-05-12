CREATE DATABASE empresa;
USE empresa;

CREATE TABLE cliente (
pk_cliente INT NOT NULL AUTO_INCREMENT primary key,
nome_cliente varchar(50) NOT NULL,
endereco_cliente varchar(80) NOT NULL,
telefone_cliente varchar(20) NOT NULL,
email_cliente varchar(50) NOT NULL
);

CREATE TABLE usuario(
pk_usuario int not null auto_increment primary key,
nome_usuario varchar(50) DEFAULT NULL,
usuario_usuario varchar(10) DEFAULT NULL,
senha_usuario varchar(32) DEFAULT NULL,
nivel_usuario int DEFAULT NULL
);


INSERT INTO cliente (nome_cliente, endereco_cliente, telefone_cliente, email_cliente)
VALUES 
('Maria Oliveira', 'Av. Brasil, 456', '(21) 99876-5432', 'maria.oliveira@email.com'),
('Carlos Pereira', 'Rua Afonso Pena, 789', '(31) 98765-4321', 'carlos.pereira@email.com'),
('Ana Souza', 'Rua do Comércio, 321', '(41) 97654-3210', 'ana.souza@email.com'),
('Ricardo Lima', 'Travessa das Palmeiras, 50', '(61) 96543-2109', 'ricardo.lima@email.com');
