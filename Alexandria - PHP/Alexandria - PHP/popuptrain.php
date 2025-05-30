<?php
// CONEXÃO COM O BANCO
$host = 'localhost:3307';
$dbname = 'bd_imagem';
$username = 'root';
$password = 'root';

$mensagem = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // INSERÇÃO DE FUNCIONÁRIO
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inserir'])) {
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];

        $sql = "INSERT INTO funcionarios (nome, telefone) VALUES (:nome, :telefone)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->execute();

        $mensagem = "Funcionário '$nome' inserido com sucesso!";
    }

    // BUSCA OS FUNCIONÁRIOS
    $stmt = $pdo->query("SELECT * FROM funcionarios");
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $mensagem = "Erro ao conectar: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Funcionários</title>
    <script>
        function mostrarPopup(msg) {
            if (msg) {
                alert(msg);
            }
        }
    </script>
</head>
<body onload="mostrarPopup('<?= addslashes($mensagem) ?>')">
    <h1>Cadastrar Funcionário</h1>
    <form method="POST">
        <label>Nome: <input type="text" name="nome" required></label><br>
        <label>Telefone: <input type="text" name="telefone" required></label><br>
        <button type="submit" name="inserir">Inserir</button>
    </form>

    <h2>Lista de Funcionários</h2>
    <ul>
        <?php foreach ($funcionarios as $funcionario): ?>
            <li><?= htmlspecialchars($funcionario['nome']) ?> - <?= htmlspecialchars($funcionario['telefone']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
