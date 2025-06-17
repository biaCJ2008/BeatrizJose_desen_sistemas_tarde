<?php

define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', 'root');
define('DB', 'senai_login');
define('PORT', 3307);

// Cria conexão orientada a objetos, mas ainda compatível com funções mysqli_*
$conexao = new mysqli(HOST, USUARIO, SENHA, DB, PORT);

// Verifica erros na conexão
if ($conexao->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conexao->connect_error);
}
?>
