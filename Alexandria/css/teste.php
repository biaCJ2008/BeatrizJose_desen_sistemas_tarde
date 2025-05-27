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
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Livros</title>
    <link rel="stylesheet" href="bilubilu.css">
</head>
<body>
    <header class="header">
        <div class="logo">
          
            <span>GESTÃO DE LIVROS</span>
        </div>
        
        <div class="brand-section">
            <div class="alexandria-logo">
                <span class="star-icon">✦</span>
                ALEXANDRIA
            </div>
        </div>
    </header>

    <main class="main-content">
        <h1 class="page-title">CADASTRAMENTO</h1>
        
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
                    <div class="stat-number">24</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-title">CATEGORIAS</div>
                    <div class="stat-number">24</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-title">AUTORES</div>
                    <div class="stat-number">24</div>
                </div>
            </div>
        </div>

        <h2 class="section-title">
            LIVROS
        </h2>

        <div class="search-section">
            <input type="text" class="search-input" placeholder="🔍 Pesquisar">
        </div>

    <div class='titleliv'>
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
                    <td><?=htmlspecialchars($livro["liv_isbn"])?></td>
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

        <h2 class="section-title">
            CATEGORIAS
        </h2>
    </main>

   

    <script src="script.js"></script>
</body>
</html>