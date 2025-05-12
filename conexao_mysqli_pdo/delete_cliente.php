<?php
// Inclui o arquivo de conexão com o banco de dados
require_once "conexao.php";

// Estabelece conexão
$conexao = conectadb();

// Define o ID do cliente que será excluído
$pk_cliente = 2;

// Prepara a consulta SQL segura
$stmt = $conexao->prepare("DELETE FROM cliente WHERE pk_cliente = ?");

// Associa o parâmetro ao valor da consulta
$stmt->bind_param("i", $pk_cliente);

// Executa a exclusão
if ($stmt->execute()) {
    echo "Cliente removido com sucesso!";
} else {
    echo "Erro ao remover cliente: " . $stmt->error;
}

// Fecha a consulta e a conexão
$stmt->close();
$conexao->close();

?>