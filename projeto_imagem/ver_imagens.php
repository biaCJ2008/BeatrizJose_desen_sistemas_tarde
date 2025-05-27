<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ob_clean(); //Limpa qualquer saida inesperada antes do header 

    //Conexao com o banco de dados
    require_once 'conecta.php';

    //Obtem o ID da imagem da URL, GARANTINDO QUE SEJA UM NUMERO INTEIRO
    $id_imagem = isset($_GET['id'])? intval($_GET['id']) : 0;

    //cria consulta para buscar a imagem no banco de dados
    $querySelecionarPorCodigo = "SELECT imagem, tipo_imagem FROM tabela_imagem WHERE codigo = ?";

    //usa prepared statement para maior segurança
    $stmt = $conexao->prepare($querySelecionarPorCodigo);
    $stmt->bind_param("i", $id_imagem);
    $stmt->execute();
    $resultado = $stmt->get_result();

    //Verifica se imagem existe no banco de dados
    if($resultado->num_rows > 0) {
      $imagem = $resultado->fetch_object();
      //Define o tipo correto da imagem (fallback para jpeg caso esteja vazio)
      $tipoImagem = !empty($imagem->tipo_imagem) ? $imagem->tipo_imagem : 'imagem/jpeg';
      header('Content-Type: ' . $tipoImagem);
      //Exibe a imagem armazenada no banco de dados 
        echo $imagem->imagem;
    }else{
        echo "Imagem não encontrada.";
    }
    //Fecha a consulta
    $stmt->close();
?>