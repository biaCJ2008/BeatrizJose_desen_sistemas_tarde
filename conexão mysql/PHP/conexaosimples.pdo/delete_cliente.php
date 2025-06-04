<?php
require_once "conexao.php";

$conexao = conectadb();

$id_cliente=1;

$stmt =$conexao->prepare("DELETE FROM cliente WHERE id_cliente=?");

if ($stmt -> execute()) {
    echo"Cliente removido com sucesso!";
} else {
    echo "Erro ao adicionar cliente: ".$stmt->error;
}

$stmt->close();
$conexao.>close();
?>