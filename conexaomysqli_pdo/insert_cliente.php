<?php
// Inclui o arquivo de conexão com o banco de dados
require_once "conexao.php";

// Estabelece conexão
$conexao = conectadb();

// Definição dos valores para inserção
$nome = "Beatriz Coimbra José";
$endereco = "Rua Kalamango, 32";
$telefone = "(41) 5555-5555";
$email = "beatrizcj@teste.com";

// Prepara a consulta SQL usando `prepare()` para evitar SQL Injection
$stmt = $conexao->prepare("INSERT INTO cliente (nome_cliente, endereco_cliente, telefone_cliente, email_cliente) VALUES (?,?,?,?)");

// Associa os parâmetros aos valores da consulta
$stmt ->bind_param("ssss", $nome, $endereco,$telefone,$email);

// Executa a inserção
if ($stmt -> execute()) {
    echo"Cliente adicionado com sucesso!";
} else {
    echo "Erro ao adicionar cliente: ".$stmt->error;
}

// Fecha a consulta e a conexão com o banco de dados
$stmt->close();
$conexao->close();
?>