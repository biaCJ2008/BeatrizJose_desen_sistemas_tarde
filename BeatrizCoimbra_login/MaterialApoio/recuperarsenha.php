<?php
session_start();
require_once 'conexao.php';
require_once 'funcoes_email.php'; //Arquivo com as funções que geram senha e simulam o envio

if($_SERVER['REQUEST_METHOD']=="POST"){
    $email = $_POST['email'];
    //Verifica se o email existe no banco

    $sql = "SELECT * FROM usuario WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if($usuario ){
        //Gera uma senha temporário aleatória

        $senha_temporaria = gerarSenhaTemporaria();
        $senha_hash=password_hash($senha_temporaria, PASSWORD_DEFAULT);
        //Atualiza a senha no banco

        $sql= "UPDATE usuario SET senha=:senha, senha_temporaria = TRUE WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':senha',$senha_hash);
        $stmt->execute();
    //Simula o envio do email(grava em txt)
    simularEnvioEmail($email, $senha_temporaria);
    echo "<script>alert('Uma senha temporaria foi gerada e enviada (simulação). Verifique o arquivo (email_simulados.txt'); window.location.href='login.php';</script>";
    } else {
   
        echo "<script>alert('E-mail não encontrado'); window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
</head>
<body>
    <h2>Recuperar Senha</h2>
    <form action="recuperar_senha.php" method="POST">
        <label for="email">Digite o seu email Cadastrado</label>
        <input type="email" id="email" name="email" required>
    </form>
</body>
</html>