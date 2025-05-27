<?php
require_once('conecta.php');
//cria a consulta sql para selecionar os dados da tabela
$querySelecao = "SELECT codigo, evento, descricao, nome_imagem, tamanho_imagem FROM tabela_imagem";
$resultado = mysqli_query($conexao, $querySelecao);
if(!$resultado){
    die("Erro na consulta:". mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armazenamento Imagens no banco de dados</title>
</head>
<body>
    <h2>Selecione um novo arquivo de imagem</h2>
    <form enctype="multipart/form-data" action="upload.php" method="POST">
        <input type="hidden" name="MAX_FILE_NAME" value ="999999999">
        <input type="text" name="evento" placeholder="Nome do Evento">
        <input type="text" name="descricao" placeholder="Descrição">
        <input type="file" name="imagem">
        <input type="submit" value="salvar">
    </form>
    <br>
    <table border = "1">
        <tr>
            <td align="center">Código</td>
            <td align="center">Evento</td>
            <td align="center">Descrição</td>
            <td align="center">Nome da Imagem</td>
            <td align="center">Tamanho</td>
            <td align="center">Visualizar Imagem</td>
            <td align="center">Excluir Imagem</td>

        </tr>
        <?php
        while($arquivos = mysqli_fetch_array($resultado)){?>
        <tr>
            <td align="center"><?php echo $arquivos['codigo'];?></td>
            <td align="center"><?php echo $arquivos['evento'];?></td>
            <td align="center"><?php echo $arquivos['descricao'];?></td>
            <td align="center"><?php echo $arquivos['nome_imagem'];?></td>
            <td align="center"><?php echo $arquivos['tamanho_imagem'];?></td>
            <td align="center">
                <a href="ver_imagens.php?id=<?php echo $arquivos['codigo'];?>">Ver imagem</a>
            </td>
            <td align="center">
                <a href="excluir_imagem.php?id=<?php echo $arquivos['codigo'];?>">Excluir imagem</a>
            </td>
        </tr>
       <?php }?>
    </table>
</body>
</html>