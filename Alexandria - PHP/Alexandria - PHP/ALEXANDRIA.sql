create database ALEXANDRIA;
use ALEXANDRIA;

CREATE TABLE TIPO_USUARIO (
    pk_tipo_user INT PRIMARY KEY auto_increment,
    tipo_user_nome VARCHAR(50) not null,
    tipo_user_descricao VARCHAR(300)
);

CREATE TABLE STATUS_MEMBRO (
    pk_status_mem INT PRIMARY KEY auto_increment,
    status_mem_nome VARCHAR(50) not null,
    status_mem_descricao VARCHAR(200)
);

CREATE TABLE CATEGORIA ( 
 pk_cat INT PRIMARY KEY auto_increment, 
 cat_nome VARCHAR(100) not null
);

CREATE TABLE AUTOR ( 
 pk_aut INT PRIMARY KEY auto_increment,
 aut_nome VARCHAR(100) not null,
 aut_sobrenome VARCHAR(150) not null,
 aut_data_nascimento DATE
);

CREATE TABLE FORNECEDOR ( 
 pk_forn INT PRIMARY KEY auto_increment,
 forn_nome VARCHAR(250) not null,
 forn_cnpj VARCHAR(18) unique,
 forn_telefone VARCHAR(16),
 forn_email VARCHAR(100),
 forn_endereco VARCHAR(250)

);

CREATE TABLE LIVRO ( 
 pk_liv INT PRIMARY KEY auto_increment,
 liv_titulo VARCHAR(200) not null,
 liv_isnb VARCHAR(13) not null unique,
 liv_edicao INT,
 liv_anoPublicacao INT,
 liv_sinopse VARCHAR(3000),
 liv_estoque INT,
 liv_dataAlteracaoEstoque DATE,
 liv_idioma VARCHAR(30),
 liv_num_paginas INT,
 liv_capa VARCHAR(255)
);

CREATE TABLE PLANO ( 
 pk_plan INT PRIMARY KEY auto_increment,
 plan_nome VARCHAR(100) not null,
 plan_valor DECIMAL(10,2),
 plan_duracao VARCHAR(50),
 plan_descricao VARCHAR(3000),
 plan_limite_emp INT default 2
);

CREATE TABLE USUARIO ( 
 pk_user INT PRIMARY KEY auto_increment,
 user_nome VARCHAR(250) not null,
 user_cpf VARCHAR(14) unique not null,
 user_email VARCHAR(250),
 user_telefone VARCHAR(16),
 user_senha VARCHAR(255) not null,
 user_login VARCHAR(20) unique,
 user_dataAdmissao DATE,
 user_dataDemissao DATE,
 user_foto VARCHAR(255),
 fk_tipoUser INT not null,
 FOREIGN KEY(fk_tipoUser) references TIPO_USUARIO(pk_tipo_user) on delete restrict on update cascade
);

CREATE TABLE MEMBRO (
 pk_mem INT PRIMARY KEY auto_increment,
 mem_nome VARCHAR(250) not null,
 mem_cpf VARCHAR(14) unique not null,
 mem_senha VARCHAR(250) not null,
 mem_email VARCHAR(250),
 mem_telefone VARCHAR(16),
 fk_status INT not null,
 fk_plan INT,
 FOREIGN KEY(fk_status) references STATUS_MEMBRO(pk_status_mem) on delete restrict on update cascade,
 FOREIGN KEY(fk_plan) references PLANO(pk_plan) on delete restrict on update cascade
);

CREATE TABLE EMPRESTIMO (
 pk_emp INT PRIMARY KEY auto_increment,
 emp_prazo INT,
 emp_dataEmp DATE,
 emp_dataDev DATE,
 emp_dataDevReal DATE,
 emp_valorMultaDiaria DECIMAL(10,2) default 1.50,
 emp_status ENUM('Empréstimo Ativo', 'Empréstimo Atrasado', 'Renovação Ativa', 'Renovação Atrasada', 'Finalizado') not null default 'Empréstimo Ativo',
 fk_mem INT not null,
 fk_user INT not null,
 FOREIGN KEY(fk_mem) references MEMBRO(pk_mem) on delete restrict on update cascade,
 FOREIGN KEY(fk_user) references USUARIO(pk_user) on delete restrict on update cascade
);

CREATE TABLE RESERVA ( 
 pk_res INT PRIMARY KEY auto_increment,
 res_prazo INT,
 res_dataMarcada DATE,
 res_dataVencimento DATE,
 res_dataFinalizada DATE,
 res_observacoes VARCHAR(1000),
 res_status ENUM('Aberta', 'Cancelada', 'Finalizada', 'Atrasada') not null default 'Aberta',
 fk_mem INT not null,
 fk_liv INT not null,
 fk_user INT not null,
 FOREIGN KEY(fk_mem) references MEMBRO(pk_mem) on delete restrict on update cascade,
 FOREIGN KEY(fk_liv) references LIVRO(pk_liv) on delete restrict on update cascade,
 FOREIGN KEY(fk_user) references USUARIO(pk_user) on delete restrict on update cascade
);

CREATE TABLE Multa ( 
 pk_mul INT PRIMARY KEY auto_increment,
 mul_valor DECIMAL(10,2),
 mul_qtdDias INT,
 mul_status ENUM('Aberta', 'Finalizada'),
 fk_mem INT not null,
 fk_emp INT not null,
 FOREIGN KEY(fk_mem) references MEMBRO(pk_mem) on delete restrict on update cascade,
 FOREIGN KEY(fk_emp) references EMPRESTIMO(pk_emp) on delete restrict on update cascade
);

CREATE TABLE PAG_PLANO ( 
 pk_pag_plan INT PRIMARY KEY auto_increment,
 pag_plan_preco DECIMAL(10,2),
 pag_plan_valorPag DECIMAL(10,2),
 pag_plan_dataPag DATE,
 pag_plan_dataVen DATE,
 pag_plan_comprovante VARCHAR(255),
 pag_plan_status ENUM('Em dia', 'Atrasado') not null,
 fk_mem INT not null,
 fk_plan INT not null,
 FOREIGN KEY(fk_mem) references MEMBRO(pk_mem) on delete restrict on update cascade,
 FOREIGN KEY(fk_plan) references PLANO(pk_plan) on delete restrict on update cascade
);

CREATE TABLE REMESSA (
 pk_rem INT PRIMARY KEY auto_increment, 
 rem_data DATE not null,
 rem_qtd INT not null,
 fk_forn INT not null,
 fk_liv INT not null,
 fk_user INT not null,
 FOREIGN KEY(fk_forn) references FORNECEDOR(pk_forn) on delete restrict on update cascade,
 FOREIGN KEY(fk_liv) references LIVRO(pk_liv) on delete restrict on update cascade,
 FOREIGN KEY(fk_user) references USUARIO(pk_user) on delete restrict on update cascade
);

/*--------------------- TABELAS JUNÇÃO ---------------------*/
CREATE TABLE FORN_LIV ( 
 fk_liv INT,
 fk_forn INT,
 PRIMARY KEY(fk_liv, fk_forn),
 FOREIGN KEY(fk_liv) references LIVRO(pk_liv) on delete restrict on update cascade,
 FOREIGN KEY(fk_forn) references FORNECEDOR(pk_forn) on delete restrict on update cascade
);

CREATE TABLE CAT_LIV ( 
 fk_liv INT,
 fk_cat INT,
 PRIMARY KEY(fk_liv, fk_cat),
 FOREIGN KEY(fk_liv) references LIVRO(pk_liv) on delete restrict on update cascade,
 FOREIGN KEY(fk_cat) references CATEGORIA(pk_cat) on delete restrict on update cascade
);

CREATE TABLE AUT_LIV ( 
 fk_liv INT,
 fk_aut INT,
 PRIMARY KEY(fk_liv, fk_aut),
 FOREIGN KEY(fk_liv) references LIVRO(pk_liv) on delete restrict on update cascade,
 FOREIGN KEY(fk_aut) references AUTOR(pk_aut) on delete restrict on update cascade
);

CREATE TABLE EMP_LIV ( 
 fk_emp INT,
 fk_liv INT,
 PRIMARY KEY(fk_emp, fk_liv),
 FOREIGN KEY(fk_emp) references EMPRESTIMO(pk_emp) on delete restrict on update cascade,
 FOREIGN KEY(fk_liv) references LIVRO(pk_liv) on delete restrict on update cascade
);

/*--------------------- INSERINDO DADOS (IA: DEEPSEEK) ---------------------*/
-- TIPO_USUARIO
INSERT INTO TIPO_USUARIO (tipo_user_nome, tipo_user_descricao) VALUES 
('Administrador', 'Possui acesso total ao sistema, incluindo configurações e relatórios'),
('Funcionário', 'Acesso limitado às funções operacionais do sistema');

-- STATUS_MEMBRO
INSERT INTO STATUS_MEMBRO (status_mem_nome, status_mem_descricao) VALUES 
('Ativo', 'Membro em dia com todas as obrigações e pode realizar empréstimos'),
('Suspenso', 'Membro temporariamente impedido de realizar empréstimos devido a pendências');

-- CATEGORIA
INSERT INTO CATEGORIA (cat_nome) VALUES 
('Ficção Científica'),
('Fantasia'),
('Romance'),
('Terror'),
('Biografia');

-- AUTOR
INSERT INTO AUTOR (aut_nome, aut_sobrenome, aut_data_nascimento) VALUES 
('George', 'Orwell', '1903-06-25'),
('J.K.', 'Rowling', '1965-07-31'),
('Stephen', 'King', '1947-09-21'),
('Clarice', 'Lispector', '1920-12-10'),
('Machado', 'de Assis', '1839-06-21'),
('Agatha', 'Christie', '1890-09-15'),
('J.R.R.', 'Tolkien', '1892-01-03'),
('Isaac', 'Asimov', '1920-01-02'),
('Jane', 'Austen', '1775-12-16'),
('Carlos', 'Drummond de Andrade', '1902-10-31');

-- FORNECEDOR
INSERT INTO FORNECEDOR (forn_nome, forn_cnpj, forn_telefone, forn_email, forn_endereco) VALUES 
('Editora Arqueiro', '12.345.678/0001-00', '(11) 1234-5678', 'contato@arqueiro.com.br', 'Rua das Letras, 123 - São Paulo/SP'),
('Companhia das Letras', '98.765.432/0001-00', '(11) 8765-4321', 'contato@companhiadasletras.com.br', 'Av. dos Livros, 456 - Rio de Janeiro/RJ'),
('Editora Abril', '11.222.333/0001-44', '(11) 2222-3333', 'vendas@abril.com.br', 'Rua das Revistas, 789 - São Paulo/SP'),
('Saraiva Distribuidora', '55.666.777/0001-88', '(11) 5555-6666', 'distribuidora@saraiva.com.br', 'Av. Comercial, 101 - São Paulo/SP'),
('Livraria Cultura', '99.888.777/0001-66', '(11) 9999-8888', 'atendimento@livrariacultura.com.br', 'Rua Cultural, 202 - São Paulo/SP'),
('Editora Record', '33.444.555/0001-77', '(21) 3333-4444', 'editora@record.com.br', 'Av. Literária, 303 - Rio de Janeiro/RJ'),
('Martins Fontes', '22.333.444/0001-55', '(11) 2222-1111', 'contato@martinsfontes.com.br', 'Rua das Fontes, 404 - São Paulo/SP'),
('Editora Globo', '44.555.666/0001-99', '(11) 4444-5555', 'editorial@globo.com.br', 'Av. da Imprensa, 505 - São Paulo/SP'),
('Editora Intrínseca', '77.888.999/0001-11', '(21) 7777-8888', 'contato@intrinseca.com.br', 'Rua dos Best-sellers, 606 - Rio de Janeiro/RJ'),
('Editora Rocco', '66.777.888/0001-22', '(21) 6666-7777', 'vendas@rocco.com.br', 'Av. dos Autores, 707 - Rio de Janeiro/RJ');

-- LIVRO
INSERT INTO LIVRO (liv_titulo, liv_isnb, liv_edicao, liv_anoPublicacao, liv_sinopse, liv_estoque, liv_dataAlteracaoEstoque, liv_idioma, liv_num_paginas, liv_capa) VALUES 
('1984', '9780451524935', 1, 1949, 'Um clássico distópico sobre vigilância governamental e controle social', 15, '2023-01-10', 'Português', 328, 'capa1984.jpg'),
('Harry Potter e a Pedra Filosofal', '9788532530799', 1, 1997, 'O primeiro livro da série que apresenta o jovem bruxo Harry Potter', 20, '2023-02-15', 'Português', 264, 'capaHP1.jpg'),
('O Iluminado', '9788525430574', 2, 1977, 'Um romance de terror sobre um hotel mal-assombrado e um menino com poderes psíquicos', 12, '2023-03-05', 'Português', 464, 'capailuminado.jpg'),
('A Hora da Estrela', '9788520923251', 3, 1977, 'A história de Macabéa, uma datilógrafa alagoana que vive no Rio de Janeiro', 8, '2023-01-20', 'Português', 96, 'capaestrela.jpg'),
('Dom Casmurro', '9788525404612', 5, 1899, 'A clássica história de Bentinho e Capitu e a dúvida sobre sua traição', 10, '2023-02-28', 'Português', 256, 'capadom.jpg'),
('Assassinato no Expresso do Oriente', '9788525414369', 1, 1934, 'Um dos mais famosos casos do detetive Hercule Poirot', 7, '2023-03-10', 'Português', 288, 'capaexpresso.jpg'),
('O Senhor dos Anéis: A Sociedade do Anel', '9788533613379', 3, 1954, 'A jornada épica para destruir o Um Anel e salvar a Terra-média', 18, '2023-01-15', 'Português', 576, 'capasociedade.jpg'),
('Fundação', '9788576572008', 1, 1951, 'O início da saga sobre a queda de um império galáctico e a tentativa de preservar o conhecimento', 9, '2023-02-20', 'Português', 320, 'capafundacao.jpg'),
('Orgulho e Preconceito', '9788594318143', 2, 1813, 'A história de Elizabeth Bennet e Mr. Darcy na Inglaterra rural', 14, '2023-03-01', 'Português', 424, 'capapreconceito.jpg'),
('Claro Enigma', '9788525416295', 1, 1951, 'Uma coletânea de poemas de Carlos Drummond de Andrade', 5, '2023-01-25', 'Português', 128, 'capaclaro.jpg'),
('A Revolução dos Bichos', '9788525434794', 1, 1945, 'Uma fábula sobre animais que tomam uma fazenda e estabelecem seu próprio governo', 11, '2023-02-10', 'Português', 152, 'capabichos.jpg'),
('Harry Potter e o Prisioneiro de Azkaban', '9788532530829', 1, 1999, 'Terceiro livro da série, onde Harry descobre mais sobre seu passado', 16, '2023-03-08', 'Português', 352, 'capaHP3.jpg'),
('It: A Coisa', '9788525431243', 1, 1986, 'Um grupo de crianças enfrenta uma entidade maligna que assume a forma de seus piores medos', 6, '2023-01-30', 'Português', 1104, 'capacoisa.jpg'),
('Perto do Coração Selvagem', '9788520923268', 1, 1943, 'O romance de estreia de Clarice Lispector', 4, '2023-02-25', 'Português', 208, 'capacoracao.jpg'),
('Memórias Póstumas de Brás Cubas', '9788525404629', 4, 1881, 'Narrado por um defunto autor, o livro critica a sociedade brasileira do século XIX', 8, '2023-03-12', 'Português', 240, 'capabrascubas.jpg'),
('O Caso dos Dez Negrinhos', '9788525414376', 1, 1939, 'Dez estranhos são convidados para uma ilha e começam a morrer um por um', 7, '2023-01-18', 'Português', 256, 'capanegrinhos.jpg'),
('O Hobbit', '9788533613409', 2, 1937, 'A aventura de Bilbo Bolseiro para ajudar anões a recuperar seu reino', 13, '2023-02-22', 'Português', 336, 'capahobbit.jpg'),
('Eu, Robô', '9788576572015', 1, 1950, 'Contos que exploram as três leis da robótica e a relação entre humanos e máquinas', 10, '2023-03-07', 'Português', 320, 'caparobo.jpg'),
('Razão e Sensibilidade', '9788594318150', 1, 1811, 'A história das irmãs Dashwood e suas diferentes abordagens ao amor', 9, '2023-01-22', 'Português', 384, 'caparazao.jpg'),
('Sentimento do Mundo', '9788525416301', 1, 1940, 'Poemas de Drummond que refletem sobre a condição humana e o mundo em transformação', 6, '2023-02-28', 'Português', 112, 'capasentimento.jpg');

-- PLANO
INSERT INTO PLANO (plan_nome, plan_valor, plan_duracao, plan_descricao, plan_limite_emp) VALUES 
('Básico', 29.90, 'Mensal', 'Plano básico com direito a 2 empréstimos simultâneos', 2),
('Intermediário', 49.90, 'Mensal', 'Plano intermediário com direito a 4 empréstimos simultâneos', 4),
('Família', 79.90, 'Mensal', 'Plano familiar com direito a 6 empréstimos simultâneos, ideal para até 4 pessoas', 6);

-- USUARIO
INSERT INTO USUARIO (user_nome, user_cpf, user_email, user_telefone, user_senha, user_login, user_dataAdmissao, user_foto, fk_tipoUser) VALUES 
('Maria Silva', '111.222.333-44', 'maria.silva@alexandria.com', '(11) 91234-5678', 'senha123', 'msilva', '2020-05-10', 'maria.jpg', 1),
('João Oliveira', '222.333.444-55', 'joao.oliveira@alexandria.com', '(11) 92345-6789', 'senha456', 'joliveira', '2021-02-15', 'joao.jpg', 2),
('Ana Santos', '333.444.555-66', 'ana.santos@alexandria.com', '(11) 93456-7890', 'senha789', 'asantos', '2022-01-20', 'ana.jpg', 2);

-- MEMBRO
INSERT INTO MEMBRO (mem_nome, mem_cpf, mem_senha, mem_email, mem_telefone, fk_status, fk_plan) VALUES 
('Carlos Pereira', '444.555.666-77', 'membro123', 'carlos.pereira@gmail.com', '(11) 94567-8901', 1, 1),
('Fernanda Lima', '555.666.777-88', 'membro456', 'fernanda.lima@hotmail.com', '(11) 95678-9012', 1, 2),
('Ricardo Almeida', '666.777.888-99', 'membro789', 'ricardo.almeida@yahoo.com', '(11) 96789-0123', 1, 3),
('Patrícia Costa', '777.888.999-00', 'membro101', 'patricia.costa@gmail.com', '(11) 97890-1234', 2, 1),
('Marcos Souza', '888.999.000-11', 'membro202', 'marcos.souza@hotmail.com', '(11) 98901-2345', 1, 2),
('Juliana Rocha', '999.000.111-22', 'membro303', 'juliana.rocha@yahoo.com', '(11) 99012-3456', 1, 1),
('Lucas Martins', '000.111.222-33', 'membro404', 'lucas.martins@gmail.com', '(11) 90123-4567', 2, 3),
('Amanda Ferreira', '123.456.789-00', 'membro505', 'amanda.ferreira@hotmail.com', '(11) 91234-5670', 1, 2),
('Roberto Gomes', '234.567.890-11', 'membro606', 'roberto.gomes@yahoo.com', '(11) 92345-6781', 1, 1),
('Tatiana Neves', '345.678.901-22', 'membro707', 'tatiana.neves@gmail.com', '(11) 93456-7892', 1, 3);

-- EMPRESTIMO
INSERT INTO EMPRESTIMO (emp_prazo, emp_dataEmp, emp_dataDev, emp_dataDevReal, emp_status, fk_mem, fk_user) VALUES 
(14, '2023-03-01', '2023-03-15', '2023-03-14', 'Finalizado', 1, 2),
(14, '2023-03-05', '2023-03-19', NULL, 'Empréstimo Ativo', 2, 1),
(14, '2023-02-20', '2023-03-06', '2023-03-10', 'Empréstimo Atrasado', 3, 3),
(14, '2023-03-10', '2023-03-24', NULL, 'Empréstimo Ativo', 4, 2),
(14, '2023-02-15', '2023-03-01', '2023-02-28', 'Finalizado', 5, 1);

-- RESERVA
INSERT INTO RESERVA (res_prazo, res_dataMarcada, res_dataVencimento, res_dataFinalizada, res_observacoes, res_status, fk_mem, fk_liv, fk_user) VALUES 
(7, '2023-03-01', '2023-03-08', '2023-03-05', 'Retirado antes do prazo', 'Finalizada', 1, 3, 2),
(7, '2023-03-05', '2023-03-12', NULL, 'Aguardando retirada', 'Aberta', 2, 5, 1),
(7, '2023-02-28', '2023-03-07', '2023-03-10', 'Não retirado no prazo', 'Atrasada', 3, 7, 3),
(7, '2023-03-10', '2023-03-17', NULL, 'Reserva especial', 'Aberta', 4, 9, 2),
(7, '2023-03-12', '2023-03-19', NULL, 'Cancelada pelo membro', 'Cancelada', 5, 11, 1);

-- Multa
INSERT INTO Multa (mul_valor, mul_qtdDias, mul_status, fk_mem, fk_emp) VALUES 
(6.00, 4, 'Finalizada', 3, 3),
(3.00, 2, 'Aberta', 5, 5),
(4.50, 3, 'Finalizada', 1, 1),
(7.50, 5, 'Aberta', 2, 2),
(9.00, 6, 'Finalizada', 4, 4);

-- PAG_PLANO
INSERT INTO PAG_PLANO (pag_plan_preco, pag_plan_valorPag, pag_plan_dataPag, pag_plan_dataVen, pag_plan_comprovante, pag_plan_status, fk_mem, fk_plan) VALUES 
(29.90, 29.90, '2023-03-01', '2023-04-01', 'comprovante1.pdf', 'Em dia', 1, 1),
(49.90, 49.90, '2023-03-05', '2023-04-05', 'comprovante2.pdf', 'Em dia', 2, 2),
(79.90, 79.90, '2023-02-28', '2023-03-28', 'comprovante3.pdf', 'Atrasado', 3, 3),
(29.90, 29.90, '2023-03-10', '2023-04-10', 'comprovante4.pdf', 'Em dia', 4, 1),
(49.90, 49.90, '2023-03-12', '2023-04-12', 'comprovante5.pdf', 'Em dia', 5, 2);

-- REMESSA
INSERT INTO REMESSA (rem_data, rem_qtd, fk_forn, fk_liv, fk_user) VALUES 
('2023-01-05', 15, 1, 1, 1),
('2023-01-10', 20, 2, 2, 2),
('2023-01-15', 12, 3, 3, 3),
('2023-02-01', 8, 4, 4, 1),
('2023-02-10', 10, 5, 5, 2);

-- FORN_LIV
INSERT INTO FORN_LIV VALUES 
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 1),
(12, 2),
(13, 3),
(14, 4),
(15, 5),
(16, 6),
(17, 7),
(18, 8),
(19, 9),
(20, 10);

-- CAT_LIV
INSERT INTO CAT_LIV VALUES 
(1, 1),
(2, 2),
(3, 4),
(4, 3),
(5, 3),
(6, 3),
(7, 2),
(8, 1),
(9, 3),
(10, 5),
(11, 1),
(12, 2),
(13, 4),
(14, 3),
(15, 3),
(16, 4),
(17, 2),
(18, 1),
(19, 3),
(20, 5);

-- AUT_LIV
INSERT INTO AUT_LIV VALUES 
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 1),
(12, 2),
(13, 3),
(14, 4),
(15, 5),
(16, 6),
(17, 7),
(18, 8),
(19, 9),
(20, 10);

-- EMP_LIV
INSERT INTO EMP_LIV VALUES 
(1, 1),
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6);

