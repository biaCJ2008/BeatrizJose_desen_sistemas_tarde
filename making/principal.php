<?php
session_start();
require_once 'conexao.php';

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        echo "<script>alert('Você precisa estar logado para acessar esta página.');</script>";
        exit();
    }

    // OBTENDO O NOME DO PERFIL DO USUÁRIO LOGADO
    $id_perfil = $_SESSION['perfil'];
    $sqlPerfil = "SELECT nome_perfil FROM perfil WHERE id_perfil = :id_perfil";
    $stmtPerfil = $pdo->prepare($sqlPerfil);
    $stmtPerfil->bindParam(":id_perfil", $id_perfil);
    $stmtPerfil->execute();
    $perfil = $stmtPerfil->fetch(PDO::FETCH_ASSOC);
    $nome_perfil = $perfil['nome_perfil'];

    // DEFINIÇÃO DAS PERMISSÕES POR PERFIL
    $permissoes = [
        //ADMINISTRADOR
        '1' =>
        ['Cadastrar' =>[
            "cadastrar_usuario.php",
            "cadastrar_perfil.php",
            "crud/cadastrar_cliente.php",
            "cadastrar_fornecedor.php",
            "cadastrar_produto.php",
            "cadastrar_funcionario.php"
        ],
        'Buscar' =>[
            "buscar_usuario.php",
            "buscar_perfil.php",
            "crud/buscar_cliente.php",
            "buscar_fornecedor.php",
            "buscar_produto.php",
            "buscar_funcionario.php"
        ],
        'Alterar' =>[
            "alterar_usuario.php",
            "alterar_perfil.php",
            "crud/alterar_cliente.php",
            "alterar_fornecedor.php",
            "alterar_produto.php",
            "alterar_funcionario.php"
        ],
        'Excluir' =>[
            "excluir_usuario.php",
            "excluir_perfil.php",
            "crud/excluir_cliente.php",
            "excluir_fornecedor.php",
            "excluir_produto.php",
            "excluir_funcionario.php"
        ] ],

        //SECRETARIA
        '2' =>
        ['Cadastrar' =>[
            "cadastro_cliente.php"
        ],
        'Buscar' =>[
            "buscar_cliente.php",
            "buscar_fornecedor.php",
            "buscar_produto.php"
        ],
        'Alterar' =>[
            "alterar_cliente.php",
            "alterar_fornecedor.php"
        ] ],

        //ALMOXARIFADO
        '3' =>
        ['Cadastrar' =>[
            "cadastro_fornecedor.php",
            "cadastro_produto.php"
        ],
        'Buscar' =>[
            "buscar_cliente.php",
            "buscar_fornecedor.php",
            "buscar_produto.php"
        ],
        'Alterar' =>[
            "alterar_fornecedor.php",
            "alterar_produto.php"
        ],
        'Excluir' =>[
            "excluir_fornecedor.php",
            "excluir_produto.php"
        ] ],

        //CLIENTE
        '4' =>
        ['Cadastrar' =>[
            "cadastro_cliente.php",
        ],
        'Buscar' =>[
            "buscar_produto.php",
        ],
        'Alterar' =>[
            "alterar_cliente.php",
        ] ],
    ];

    //OBTENDO AS OPÇÕES DISPONÍVEIS PARA O PERFIL LOGADO
    $opcoes_menu = $permissoes[$id_perfil];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAINEL PRINCIPAL</title>
    <link rel="stylesheet" href="./styles.css">
    <script src="scripts.js"></script>
</head>
<body>
    <header>
        <div class="saudacao">
            <h2>Bem-vindo, <?php echo $_SESSION["usuario"];?>! Perfil: <?php echo $nome_perfil;?></h2>
        </div>

        <div class="logout">
            <form action="logout.php" method="POST">
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>
    <nav>
        <ul class="menu">
            <?php foreach($opcoes_menu as $categoria=>$arquivos): ?>
                <li class="dropdown">
                    <a href="#"><?=$categoria ?></a>
                    <ul class="dropdown-menu">
                        <?php foreach($arquivos as $arquivo): ?>
                            <li>
                                <a href="<?= $arquivo?>"><?= ucfirst(str_replace("_", " ", basename($arquivo, ".php")))?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</body>
</html>