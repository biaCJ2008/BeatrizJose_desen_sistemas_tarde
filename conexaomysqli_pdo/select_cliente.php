<?php
// Inclui o arquivo de conexão com o banco de dados
require_once "conexao.php";

// Estabelece conexão
$conexao = conectadb();

// Define a consulta SQL para buscar clientes
$sql = "SELECT pk_cliente, nome_cliente, email_cliente FROM cliente";

// Executa a consulta no banco
$result = $conexao->query($sql);

// Verifica se há registros retornados
if ($result->num_rows > 0) {
    // Itera sobre os resultados e exibe cada cliente encontrado 
    while ($linha = $result->fetch_assoc()) {
        echo "ID: " . $linha["pk_cliente"] . " - Nome: " . $linha["nome_cliente"] . " - Email: " . $linha["email_cliente"] . "<br>";
    }
} else {
    // Caso nenhum resultado seja encontrado
    echo "Nenhum cliente cadastrado.";
}

// Fecha a conexão
$conexao->close();
?>
