<?php
require "conexao.php";

$conexao = conectarBanco();

$stmt = $conexao->prepare("SELECT * FROM membro");
$stmt->execute();
$result = $stmt->get_result();
$membros = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Clientes</title>
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
            <h1>GESTÃO DE CLIENTES</h1>
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
                    <span class="plus-icon">+ NOVO CLIENTE</span>
          
            </div>
        </div>

        
        <div class = "titulo"><h2>Categorias</h2></div>

        <div class='titleliv'>
            <div class="tabela">
                <div class="tisch">
                    <table>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                        </tr>
                        <?php foreach ($membros as $membro): ?>
                            <tr>
                                <td><?= htmlspecialchars($membro["mem_nome"]) ?></td>
                                <td><?= htmlspecialchars($membro["mem_cpf"]) ?></td>
                                <td><?= htmlspecialchars($membro["mem_telefone"]) ?></td>
                                <td><?= htmlspecialchars($membro["mem_email"]) ?></td>

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
</body>

</html>