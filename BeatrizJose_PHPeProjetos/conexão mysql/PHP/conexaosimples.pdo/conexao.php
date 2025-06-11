<?php
//Definição das credenciais de acesso ao banco de dados
$nomeservidor = "localhost:3307"; //endereço do servidor
$usuario = "root"; //nome de usuario do banco
$senha = "root"; //senha do banco
$bancodedados = "empresa"; //nome do banco de dados

//Criação da conexão com MySQLi
$conn = mysqli_connect($nomeservidor, $usuario, $senha, $bancodedados);

//Verificação da conexão
if(!$conn){//Caso a conexão falhe, interrompe o script e exibe uma mensagem de erro
    die("Conexão falhou:".mysqli_connect_error());}

    //Configuração do conjunto de caracteres para evitar problemas de acentuação
    mysqli_set_charset($conn, "utf8mb4");

    //Mensagem indicando que a conexão foi estabelecida
    echo "Conexão bem-sucedida!";

//Consulta SQL para obter clientes
$sql = "SELECT id_cliente, nome_cliente, email_cliente FROM cliente";
$result = mysqli_query($conn,$sql);

//Verifica se há resultados na consulta
if (mysqli_num_rows($result)>0){
    //Itera sobre os resultados e exibe dados
    while($linha = mysqli_fetch_assoc($result)){
        echo "ID:".$linha ["id_cliente"]."-Nome:".$linha["nome_cliente"]."-Email:".$linha["email_cliente"]. "<br/>";}
    }else{
        echo "Nenhum resultado encontrado.";}
        //Fecha a conexão com o banco de dados
        mysqli_close($conn);
?>
