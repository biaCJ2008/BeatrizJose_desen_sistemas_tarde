<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Visualizar Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="footer.css">
</head>

<body>
  <?php
  include('navbar.php');
  include('conexao.php'); // ou include('config.php'); dependendo do nome do seu arquivo de conexão
  ?>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">

        <!-- Exibe mensagem de sucesso/erro -->
        <?php if (isset($_SESSION['message'])): ?>
          <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
          <?php
          unset($_SESSION['message']);
          unset($_SESSION['message_type']);
          ?>
        <?php endif; ?>

        <div class="card">
          <div class="card-header">
            <h4>Visualizar Cliente
              <a href="barrades.php" class="btn btn-danger float-end">Voltar</a>
            </h4>
          </div>
          <div class="card-body">
            <?php
            if (isset($_GET['id'])) {
              $cliente_id = mysqli_real_escape_string($conexao, $_GET['id']);

              // Consulta SQL para buscar o cliente
              $query = "SELECT * FROM cliente WHERE id_cliente = '$cliente_id'";
              $result = mysqli_query($conexao, $query);

              if (mysqli_num_rows($result) > 0) {
                $cliente = mysqli_fetch_array($result);
                ?>
                <div class="mb-3">
                  <label>Nome</label>
                  <p class="form-control"><?= htmlspecialchars($cliente['nome_cliente']) ?></p>
                </div>
                <div class="mb-3">
                  <label>Email</label>
                  <p class="form-control"><?= htmlspecialchars($cliente['email']) ?></p>
                </div>
                <div class="mb-3">
                  <label>Telefone</label>
                  <p class="form-control"><?= htmlspecialchars($cliente['telefone']) ?></p>
                </div>
                <div class="mb-3">
                  <label>Endereço</label>
                  <p class="form-control"><?= htmlspecialchars($cliente['endereco']) ?></p>
                </div>
                <?php
              } else {
                echo "<h5>Cliente não encontrado.</h5>";
              }
            } else {
              echo "<h5>ID do cliente não fornecido.</h5>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer>Beatriz Coimbra José - TDESN V3</footer>

</body>

</html>