<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Formulario Cadastro</title>
</head>
<body>
    <div class="container">
        <h1>Cadastro</h1>
        <h2>Funcionário</h2>
        <!--Formulario para cadastrar funcionario-->
        <form action="salvar_funcionario.php" method="POST" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone">

        <!--campo para fazer upload da foto do funcionario-->
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto">

            <button type='submit' name='telefone' id='telefone' required>Cadastrar</button>
        </form>
    </div> 
</body>
</html>