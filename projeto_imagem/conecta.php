<?php
//Definição das credenciais de conexão ao banco de daodos
$servername = "localhost:3307";
$username= "root";
$password = "root";
$dbname = "armazena_imagem";
//Criando a conexão usando mysqli
$conexao = new mysqli($servername, $username, $password, $dbname);
//Verificando se a conexão foi bem sucedida 
if ($conexao->connect_error){
    die("Falha na conexão:".$conexao->connect_error);
}
?>