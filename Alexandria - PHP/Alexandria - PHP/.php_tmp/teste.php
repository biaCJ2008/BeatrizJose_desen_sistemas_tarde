<?php
require "conexao.php";

$conexao = conectarBanco();

// Buscar todos os livros
$stmt = $conexao->prepare("SELECT * FROM livro");
$stmt->execute();
$result = $stmt->get_result();
$livros = $result->fetch_all(MYSQLI_ASSOC);

// Contar total de livros
$stmt2 = $conexao->prepare("SELECT COUNT(*) AS total FROM livro");
$stmt2->execute();
$result2 = $stmt2->get_result();
$qtdLivros = $result2->fetch_assoc();

// Buscar todas as categorias
$stmt3 = $conexao->prepare("SELECT * FROM categoria");
$stmt3->execute();
$result3 = $stmt3->get_result();
$categorias = $result3->fetch_all(MYSQLI_ASSOC);

// Contar total de categorias
$stmt4 = $conexao->prepare("SELECT COUNT(*) AS total FROM categoria");
$stmt4->execute();
$result4 = $stmt4->get_result();
$qtdCategorias = $result4->fetch_assoc();

// Buscar todas os autores
$stmt5 = $conexao->prepare("SELECT * FROM autor");
$stmt5->execute();
$result5 = $stmt5->get_result();
$autores = $result5->fetch_all(MYSQLI_ASSOC);

// Contar total de autores
$stmt6 = $conexao->prepare("SELECT COUNT(*) AS total FROM autor");
$stmt6->execute();
$result6 = $stmt6->get_result();
$qtdCategorias = $result6->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Livros</title>
    <link rel="stylesheet" href="./css/bilubilu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="js/geral.js"></script>
</head>

<body>
    <nav>
        <div id="iconeMenu">
            <!-- Adicionando um ícone animado para abrir o menu de navegação -->
            <div class="barrasIconeMenu" onclick="animaIconeMenu(this)">
                <div id="barra1"></div>
                <div id="barra2"></div>
                <div id="barra3"></div>
            </div>
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
    <header>
        <div id="logo" class="logo">
            <h1>GESTÃO DE LIVROS</h1>
        </div>
        <div class="brand-section">
            <div class="alexandria-logo">
                <div class="img"> <img src="img/LOGO.png" class="logoGestao" alt="Logo Alexandria"> </div><!---Logo-->
            </div>
        </div>
    </header>

    <main class="main-content">
            <div class="titulo">
                <h2>CADASTRAMENTO</h2>
            </div>
            <div class="top-section">
                <div class="actions-section">
                    <button class="action-btn">
                        <span class="plus-icon">+</span>
                        NOVO LIVRO
                    </button>
                    <button class="action-btn">
                        <span class="plus-icon">+</span>
                        NOVO AUTOR
                    </button>
                    <button class="action-btn">
                        <span class="plus-icon">+</span>
                        NOVA CATEGORIA
                    </button>
                </div>

            <div class="stats-section">
                <div class="stat-card">
                    <div class="stat-title">LIVROS</div>
                    <div class="stat-number"><?= $qtdLivros['total'] ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">CATEGORIAS</div>
                    <div class="stat-number">--</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">AUTORES</div>
                    <div class="stat-number">--</div>
                </div>
            </div>
        </div>
        <div class="campo"></div>

        <div class="search-section">
            <div class="titulo">
                <h2>LIVROS</h2>
            </div>
            <div class='barra'>
                <input type="text" class="search-input" placeholder="🔍 Pesquisar">
            </div>
        </div>

        <div class='titleliv'>
            <div class="tabela">
                <div class="tisch">
                    <table>
                        <tr>
                            <th>Título</th>
                            <th>ISBN</th>
                            <th>Idioma</th>
                            <th>Páginas</th>
                            <th>Estoque</th>
                            <th>Ação</th>
                        </tr>
                        <?php foreach ($livros as $livro): ?>
                            <tr>
                                <td><?= htmlspecialchars($livro["liv_titulo"]) ?></td>
                                <td><?= htmlspecialchars($livro["liv_isbn"]) ?></td>
                                <td><?= htmlspecialchars($livro["liv_idioma"]) ?></td>
                                <td><?= htmlspecialchars($livro["liv_num_paginas"]) ?></td>
                                <td><?= htmlspecialchars($livro["liv_estoque"]) ?></td>
                                <td>
                                    <i class='fas fa-trash-alt'
                                        style="font-size: 20px; color: #a69c60; margin-right: 7px;"></i>
                                    <i class="fas fa-pencil-alt" style="font-size: 20px; color: #a69c60;"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

        <div class = "titulo"><h2>Categorias</h2></div>

        <div class='titleliv'>
            <div class="tabela">
                <div class="tisch">
                    <table>
                        <tr>
                            <th>Categoria</th>
                            <th>Quantidade de Livros</th>
                        </tr>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr>
                                <td><?= htmlspecialchars($categoria["cat_nome"]) ?></td>
                                <!--<td><?= htmlspecialchars($categoria["pk_cat"]) ?></td>-->
                                <td>
                                    <i class='fas fa-trash-alt'
                                        style="font-size: 20px; color: #a69c60; margin-right: 7px;"></i>
                                    <i class="fas fa-pencil-alt" style="font-size: 20px; color: #a69c60;"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="search-section">
            <div class="titulo">
                <h2>Autor</h2>
            </div>
            <div class='barra'>
                <input type="text" class="search-input" placeholder="🔍 Pesquisar">
            </div>
        </div>

        <div class='titleliv'>
            <div class="tabela">
                <div class="tisch">
                    <table>
                        <tr>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>Data de Nascimento</th>
                            <th>Quantidade de livros no catalogo</th>
                        </tr>
                        <?php foreach ($autores as $autor): ?>
                            <tr>
                                <td><?= htmlspecialchars($autor["aut_nome"]) ?></td>
                                <td><?= htmlspecialchars($autor["aut_sobrenome"]) ?></td>
                                <td><?= htmlspecialchars($autor["aut_data_nascimento"]) ?></td>
                                <td>
                                    <i class='fas fa-trash-alt'
                                        style="font-size: 20px; color: #a69c60; margin-right: 7px;"></i>
                                    <i class="fas fa-pencil-alt" style="font-size: 20px; color: #a69c60;"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

        
    </main>
</body>

</html>