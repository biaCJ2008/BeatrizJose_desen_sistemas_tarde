<?php

$servername = "localhost";  // host correto, só "localhost"
$port = 3307;               // porta separada
$username = "root";
$password = "";
$dbname = "ALEXANDRIA";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    echo "Conectado com sucesso!";
} catch (mysqli_sql_exception $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>