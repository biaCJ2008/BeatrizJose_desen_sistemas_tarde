<?php
function conectarBanco() {
    $servername = "localhost";
    $port = 3307;
    $username = "root";
    $password = "";
    $dbname = "ALEXANDRIA";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $conn = new mysqli($servername, $username, $password, $dbname, $port);
        return $conn;
    } catch (mysqli_sql_exception $e) {
        die("Erro na conexão: " . $e->getMessage());
    }
}
?>

?>