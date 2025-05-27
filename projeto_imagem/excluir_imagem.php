<?php
 //Conexao com o banco de dados
 require_once 'conecta.php';

 //Obtem o ID da imagem da URL, GARANTINDO QUE SEJA UM NUMERO INTEIRO
 $id_imagem = isset($_GET['id'])? intval($_GET['id']) : 0;
 //Verifica se o ID é válido e maior que zero

 if($id_imagem > 0){
    //Cria a query segura a prepared statement
    $queryExclusao = 'DELETE FROM tabela_imagem WHERE codigo = ?';

    //prepara query
    $stmt = $conexao->prepare($queryExclusao);
    $stmt->bind_param("i", $id_imagem); //Define o ID como um inteiro
    //Executa a exclusao
    if($stmt->execute()){
        echo "Imagem excluída com sucesso.";
    } else {
        die("Fecha a consulta:" . $stmt->error);
    }
    $stmt->close(); //Fecha a consulta
 }else{
    echo "ID inválido.";
    //Redireciona para o index.php e garante que o script pare
    header('Location: index.php');
    exit();
 }
?>