<?php
require_once 'conexao.php';
session_start();
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="footer.css">
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="container mt-4">
        <?php include('mensagem.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Clientes
                            <a href="cliente_create.php" class="btn btn-primary float-end">Adicionar Cliente</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Endereço</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM cliente";
                                $clientes = mysqli_query($conexao, $sql);

                                if (mysqli_num_rows($clientes) > 0) {
                                    foreach ($clientes as $cliente) {
                                        // Verificar qual chave existe para o ID
                                        $id_cliente = isset($cliente['id']) ? $cliente['id'] :
                                            (isset($cliente['id_cliente']) ? $cliente['id_cliente'] :
                                                (isset($cliente['cliente_id']) ? $cliente['cliente_id'] : ''));
                                        ?>
                                        <tr>
                                            <td><?= $id_cliente ?></td>
                                            <td><?= isset($cliente['nome_cliente']) ? $cliente['nome_cliente'] : (isset($cliente['nome']) ? $cliente['nome'] : '') ?>
                                            </td>
                                            <td><?= isset($cliente['email']) ? $cliente['email'] : '' ?></td>
                                            <td><?= isset($cliente['telefone']) ? $cliente['telefone'] : '' ?></td>
                                            <td><?= isset($cliente['endereco']) ? $cliente['endereco'] : (isset($cliente['endereço']) ? $cliente['endereço'] : '') ?>
                                            </td>
                                            <td>
                                                <a href="cliente_view.php?id=<?= $id_cliente ?>"
                                                    class="btn btn-secondary btn-sm">Visualizar</a>
                                                <a href="cliente_edit.php?id=<?= $id_cliente ?>"
                                                    class="btn btn-success btn-sm">Editar</a>
                                                <form action="delete.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="id" value="<?= $id_cliente ?>">
                                                    <button
                                                        onclick="return confirm('Tem certeza que deseja excluir este cliente?')"
                                                        type="submit" name="delete_cliente"
                                                        class="btn btn-danger btn-sm">Excluir</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>Nenhum cliente encontrado</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <footer>Beatriz Coimbra José - TDESN V3</footer>
</body>

</html>