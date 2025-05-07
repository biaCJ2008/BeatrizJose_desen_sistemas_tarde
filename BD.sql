
create database empresa;
use empresa;
create table cliente(
pk_cliente int not null auto_increment primary key,
nome_cliente varchar (20) not null,
endereco_cliente varchar(80) not null,
telefone_cliente varchar(20) not null,
email_cliente varchar (50) not null
);

create table usuario(
id_usuario varchar(10) default null,
nome_usuario varchar(50) default null,
senha_usuario varchar(32) default null,
nivel_usuario int default null
);

-- Inserting data into cliente table
INSERT INTO cliente (nome_cliente, endereco_cliente, telefone_cliente, email_cliente) VALUES
('João Silva', 'Rua das Flores, 123 - São Paulo/SP', '(11) 9999-8888', 'joao.silva@email.com'),
('Maria Santos', 'Av. Paulista, 1000 - São Paulo/SP', '(11) 7777-6666', 'maria.santos@email.com'),
('Carlos Oliveira', 'Rua XV de Novembro, 50 - Curitiba/PR', '(41) 8888-7777', 'carlos.oliveira@email.com'),
('Ana Pereira', 'Av. Brasil, 200 - Rio de Janeiro/RJ', '(21) 6666-5555', 'ana.pereira@email.com'),
('Pedro Costa', 'Rua da Praia, 300 - Salvador/BA', '(71) 5555-4444', 'pedro.costa@email.com');

-- Inserting data into usuario table
INSERT INTO usuario (id_usuario, nome_usuario, senha_usuario, nivel_usuario) VALUES
('admin', 'Administrador do Sistema', MD5('senha123'), 1),
('gerente', 'Gerente Geral', MD5('gerente456'), 2),
('atendente', 'Atendente Comum', MD5('atend789'), 3),
('supervisor', 'Supervisor de Equipe', MD5('sup1234'), 2),
('analista', 'Analista de Sistemas', MD5('anal567'), 3);