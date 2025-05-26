<?php
function conectarBanco() {
    $servername = "localhost:3307";
    $username = "root";
    $password = "root";
    $dbname = "ALEXANDRIA";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        return $conn;
    } catch (mysqli_sql_exception $e) {
        die("Erro na conexão: ".$e->getMessage());
    }
}

?>