<?php
session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha']; 

    $sql = 'SELECT * from usuario WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION["usuario"] = $usuario['nome'];
        $_SESSION["perfil"] = $usuario['id_perfil'];
        $_SESSION["id_usuario"] = $usuario['id_usuario'];

        if ($usuario['senha_temporaria']) {
            header("Location: alterar_senha.php");
            exit();
        }

        header("Location: principal.php"); 
        exit();
    } else {
        echo "<script>alert('Email ou senha incorretos'); window.location.href='login.php';</script>";
    }
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="POST"></form>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="senha">Senha</label>
    <input type="password" id="senha" name="senha" required>
    <button type="submit"></button> Entrar</button>

    <p><a href="recuperar_senha.php">Esqueci minha senha</a></p>
</body>
</html>
