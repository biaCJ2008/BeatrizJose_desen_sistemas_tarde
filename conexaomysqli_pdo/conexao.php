<?php
//Habilida relatório detalhado de erros no MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/**
 * Função para conectar ao banco de dados
 * Retorna um objeto de conexão MySQLi ou interrompe o script em caso de erro.
 */
function conectadb() {
    // Configuração do banco de dados 
    $nomeservidor = "localhost:3307"; // Endereço do servidors
    $usuario = "root"; // Nome de usuario do banco
    $senha = "root"; // Senha do banco
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