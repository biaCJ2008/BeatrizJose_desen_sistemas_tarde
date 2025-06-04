<?php
//Habilida relatório detalhado de erros no MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function conectadb() {
    // Configuração do banco de dados 
    $nomeservidor = "localhost"; // Endereço do servidors
    $usuario = "root"; // Nome de usuario do banco
    $senha = ""; // Senha do banco
    $bancodedados = "empresa"; // Nome do banco de dados

    try {
        // Criação da conexão
        $con = new mysqli($nomeservidor, $usuario, $senha, $bancodedados);
        
        // Definição do conjunto de caracteres para evitar problemas de pontuação
        $con->set_charset("utf8mb4"); // Retorna o objeto
        return $con;
    } catch (Exception $e) {
        // Exibe mensagem de erro e encerra o script
        die("Erro na conexão:".$e->getMessage());
    }
}
?>