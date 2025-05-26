<?php

require "conexao.php";

$conexao = conectarBanco();
$stmt = $conexao->prepare("SELECT * FROM livro");
$stmt->execute();
$livros = $stmt->fetchAll();

$stmt2 = $conexao->prepare("SELECT COUNT('liv_titulo') from livro");
$stmt2->execute();
$qtdLivros = $stmt2->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title> INÍCIO </title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/geral.css">
    <script src="js/geral.js"></script>
</head>

<body>
    <header>
        <nav>
            <div id="iconeMenu">
                <!-- Adicionando um ícone animado para abrir o menu de navegação -->
                <div class="barrasIconeMenu" onclick="animaIconeMenu(this)">
                    <div id="barra1"></div>
                    <div id="barra2"></div>
                    <div id="barra3"></div>
                </div>
            </div>
    
                <div class="img"><img src="img/LOGO.png" class="logoRight" alt="Descrição da Imagem"></div>
                <button style="border: none; background: none; padding: 0;"> <img src="img/icon conta usuário.png" class="logoRight" id="profileimg" alt="Descrição da Imagem"></button>

            </div>

            <!-- Adicionando configuração para abrir um menu lateral -->
            <div id="navegaMenu" class="menuLateral">
                <h3 id="cabecalhoMenu">Menu</h3>
                <a href="#" class="linkMenu">Home</a>
                <a href="#" class="linkMenu">Livros</a>
                <a href="#" class="linkMenu">Empréstimos</a>
                <a href="#" class="linkMenu">Membros</a>
                <a href="#" class="linkMenu">DashBoard</a>
                <a href="#" class="linkMenu">Funcionários</a>
            </div>
        </nav>

        <div id="cabecalho">
            <h1> GESTÃO DE LIVROS </h1>
        </div>
</header>

            <h2>CADASTRAMENTO</h2>
            <div class="books"><button>+ Novo Livro</button></div>
            <div class="author"><button>+ Novo Autor</button></div>
            <div class="category"><button>+ Nova Categoria</button></div>
            <div class="containerCounts">
                <div class="containerCountRegistro">
                    <p>Livros</p>
                    <div class="countRegistro">
                        <p><?php $qtdLivros; ?></p>
                    </div>
                </div>
                <div class="containerCountRegistro">
                    <p>Autores</p>
                    <div class="countRegistro">
                        <p><?php $qtdLivros; ?></p>
                    </div>
                </div>
                <div class="containerCountRegistro">
                    <p>Categorias</p>
                    <div class="countRegistro">
                        <p><?php $qtdLivros; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="input-group">
            <div class="input-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input 
                id="search" 
                type="text" 
                class="input-field" 
                placeholder="Pesquisar"
            >
        </div>
     </div>
    <div class='titleliv'><h2>LIVROS</h2>
    <div class="tabela">
        <div class="tisch">
            <table>
                <tr>
                    <th>Título</th>
                    <th>ISBN</th>
                    <!--<th>Autor</th>
                    <th>Categoria</th>-->
                    <th>Idioma</th>
                    <th>Páginas</th>
                    <th>Estoque</th>
                    <th>Ação</th>
                </tr>
                <?php foreach($livros as $livro): ?>
                <tr>
                    <td><?=htmlspecialchars($livro["liv_titulo"])?></td>
                    <td><?=htmlspecialchars($livro["liv_isnb"])?></td>
                    <td><?=htmlspecialchars($livro["liv_idioma"])?></td>
                    <td><?=htmlspecialchars($livro["liv_num_paginas"])?></td>
                    <td><?=htmlspecialchars($livro["liv_estoque"])?></td>
                    <td><i class='fas fa-trash-alt' style="font-size: 20px; color:  #a69c60; margin-right: 7px;"></>
                    <i class="fas fa-pencil-alt" style="font-size: 20px; color: #a69c60;"></i></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</body>

</html>


