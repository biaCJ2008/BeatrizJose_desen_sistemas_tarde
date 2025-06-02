<?php
//CONEXÃO COM O BANCO DE DADOS
$host = 'localhost:3307';
$dbname = 'bd_imagem';
$username = 'root';
$password = 'root';

try {
    //CRIA UMA NOVA INSTANCIA DE pdo PARA CONECTAR AO BANCO DE DADOS
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//DEFINE O MODO DE ERRO DO pdo PARA EXCEÇÕES

    //Recupera todos os funcionarios do banco de dados

    $sql = "SELECT INTO funcionarios (nome, telefone,nome_foto,tipo_foto,foto) VALUES (:nome, :telefone,:nome_foto,:tipo_foto,:foto)";
    $stmt = $pdo->prepare($sql);//Prepara a instrução SQL para execução
    $stmt_excluir = $pdo->prepare($sql_excluir);
    $stmt_excluir->bindParam(':id', $excluir_i, PDO::PARAM_INT);
    $stmt->execute();

    //Redireciona para excluir 
    header("Location:" . $_SERVER['PHP_SELF']);
    exit();
} catch (PDOException $e) {
    echo "Erro." . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta funcionário</title>
</head>

<body>
    <h1>Consulta de funcionário</h1>
    <ul>
        <?php foreach ($funcionarios as $funcionario): ?>
            <li>
            <a href="visualizar_funcionario.php?id<?$funcionario['id']?>">
            <?=htmlspecialchars($funcionario['nome'])?></a>
            <form method="POST" style="display:inline;">
                <input type="hidden"  name="id" value="<?=htmlspecialchars($funcionario['id'])?>">
                <button type="submit" name="excluir">Excluir</button>
            </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>