<?php

require_once "conexao.php";
$conexao = conectadb();

$nome ="Beatriz";
$endereco="Rua Kalamango, 32";
$telefone="(41) 5555-5555";
$email="beatriz@teste.com";

$id_cliente=1

$stmt = $conexao->prepare("UPDATE cliente SET nome_cliente=?, endereco_cliente=?, telefone_cliente=?, email_cliente=? WHERE id_cliente=?");

$stmt->bind_param("ssss",$nome, $endereco,$telefone,$email,$id_cliente);

if ($stmt -> execute()) {
    echo"Cliente adicionado com sucesso!";
} else {
    echo "Erro ao adicionar cliente: ".$stmt->error;
}

$stmt->close();
$conexao->close();
?>