<?php

// Inicia a sessão para poder usar variáveis $_SESSION (mensagens flash, login, etc)
session_start();

// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

if(isset($_POST['create_cliente'])){
    // Código para criar cliente
}

if(isset($_POST['update_cliente'])){
    // Código para atualizar cliente  
}

// Verifica se o formulário de exclusão de cliente foi enviado
if (isset($_POST['delete_cliente'])) {
    // CORREÇÃO: Pegar o ID do campo 'id', não do botão 'delete_cliente'
    $id_cliente = mysqli_real_escape_string($conexao, trim($_POST['id']));

    // Verifica se o ID foi fornecido
    if (empty($id_cliente)) {
        $_SESSION['mensagem'] = "ID do cliente é obrigatório para exclusão!";
        $_SESSION['tipo'] = "danger";
        header("Location: index.php");
        exit();
    }

    // Primeiro verifica se o cliente existe
    $verifica_sql = "SELECT nome_cliente FROM cliente WHERE id_cliente = '$id_cliente'";
    $resultado_verifica = mysqli_query($conexao, $verifica_sql);
    
    if (mysqli_num_rows($resultado_verifica) == 0) {
        $_SESSION['mensagem'] = "Cliente não encontrado!";
        $_SESSION['tipo'] = "danger";
        header("Location: index.php");
        exit();
    }

    // Pega o nome do cliente para a mensagem
    $dados_cliente = mysqli_fetch_assoc($resultado_verifica);
    $nome_cliente = $dados_cliente['nome_cliente'];

    // Executa a exclusão
    $sql = "DELETE FROM cliente WHERE id_cliente = '$id_cliente'";
    if (mysqli_query($conexao, $sql)) {
        // Se deu certo, armazena mensagem de sucesso na sessão
        $_SESSION['mensagem'] = "Cliente '$nome_cliente' excluído com sucesso!";
        $_SESSION['tipo'] = "success";
        header("Location: excluir_cliente.php");
        exit();
    } else {
        // Se deu erro na query, exibe mensagem de erro com detalhe
        $_SESSION['mensagem'] = "Erro ao excluir cliente: " . mysqli_error($conexao);
        $_SESSION['tipo'] = "danger";
        header("Location: excluir_cliente.php");
        exit();
    }
}

?>

<?php
require_once 'conexao.php';
session_start();

// Capturar o termo de pesquisa
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lista de Clientes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            <!-- Barra de Pesquisa -->
            <div class="row mb-4">
              <div class="col-md-8">
                <form method="GET" action="" class="d-flex">
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control"
                      placeholder="Pesquisar por ID, nome, email, telefone ou endereço..."
                      value="<?= htmlspecialchars($search) ?>">
                    <button class="btn btn-outline-primary" type="submit">
                      Buscar
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <?php if (!empty($search)): ?>
              <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                Resultados da pesquisa por: <strong>"<?= htmlspecialchars($search) ?>"</strong>
              </div>
            <?php endif; ?>

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
                // Função para destacar termo pesquisado
                function highlightSearch($text, $search)
                {
                  if (empty($search) || empty($text))
                    return $text;
                  return preg_replace('/(' . preg_quote($search, '/') . ')/i', '<mark>$1</mark>', $text);
                }

                // Primeiro, vamos descobrir quais colunas existem na tabela
                $columns_query = "SHOW COLUMNS FROM cliente";
                $columns_result = mysqli_query($conexao, $columns_query);
                $available_columns = [];

                while ($column = mysqli_fetch_assoc($columns_result)) {
                  $available_columns[] = $column['Field'];
                }

                // Construir a query com filtro de pesquisa
                $sql = "SELECT * FROM cliente";

                if (!empty($search)) {
                  $search_escaped = mysqli_real_escape_string($conexao, $search);
                  $where_conditions = [];

                  // Verificar quais campos de busca existem na tabela
                  $search_fields = ['id', 'id_cliente', 'cliente_id', 'nome', 'nome_cliente', 'email', 'telefone', 'endereco', 'endereço'];

                  foreach ($search_fields as $field) {
                    if (in_array($field, $available_columns)) {
                      $where_conditions[] = "$field LIKE '%$search_escaped%'";
                    }
                  }

                  if (!empty($where_conditions)) {
                    $sql .= " WHERE (" . implode(' OR ', $where_conditions) . ")";
                  }
                }

                // Ordenar por ID primeiro
                if (in_array('id', $available_columns)) {
                  $sql .= " ORDER BY id ASC";
                } elseif (in_array('id_cliente', $available_columns)) {
                  $sql .= " ORDER BY id_cliente ASC";
                } elseif (in_array('cliente_id', $available_columns)) {
                  $sql .= " ORDER BY cliente_id ASC";
                } else {
                  // Se não houver campo ID, ordenar por nome
                  if (in_array('nome_cliente', $available_columns)) {
                    $sql .= " ORDER BY nome_cliente ASC";
                  } elseif (in_array('nome', $available_columns)) {
                    $sql .= " ORDER BY nome ASC";
                  }
                }

                $clientes = mysqli_query($conexao, $sql);
                $total_resultados = mysqli_num_rows($clientes);

                if ($total_resultados > 0) {
                  foreach ($clientes as $cliente) {
                    // Verificar qual chave existe para o ID
                    $id_cliente = isset($cliente['id']) ? $cliente['id'] :
                      (isset($cliente['id_cliente']) ? $cliente['id_cliente'] :
                        (isset($cliente['cliente_id']) ? $cliente['cliente_id'] : ''));

                    $nome = isset($cliente['nome_cliente']) ? $cliente['nome_cliente'] : (isset($cliente['nome']) ? $cliente['nome'] : '');
                    $email = isset($cliente['email']) ? $cliente['email'] : '';
                    $telefone = isset($cliente['telefone']) ? $cliente['telefone'] : '';
                    $endereco = isset($cliente['endereco']) ? $cliente['endereco'] : (isset($cliente['endereço']) ? $cliente['endereço'] : '');
                    ?>
                    <tr>
                      <td><?= $id_cliente ?></td>
                      <td><?= highlightSearch($nome, $search) ?></td>
                      <td><?= highlightSearch($email, $search) ?></td>
                      <td><?= highlightSearch($telefone, $search) ?></td>
                      <td><?= highlightSearch($endereco, $search) ?></td>
                      <td>
                        <a href="cliente_view.php?id=<?= $id_cliente ?>" class="btn btn-secondary btn-sm">
                          <i class="fas fa-eye"></i> Visualizar
                        </a>
                        <a href="cliente_edit.php?id=<?= $id_cliente ?>" class="btn btn-success btn-sm">
                          <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="delete.php" method="POST" class="d-inline">
                          <input type="hidden" name="id" value="<?= $id_cliente ?>">
                          <button onclick="return confirm('Tem certeza que deseja excluir este cliente?')" type="submit"
                            name="delete_cliente" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Excluir
                          </button>
                        </form>
                      </td>
                    </tr>
                    <?php
                  }
                } else {
                  $mensagem = !empty($search) ?
                    "Nenhum cliente encontrado para a pesquisa \"" . htmlspecialchars($search) . "\"" :
                    "Nenhum cliente encontrado";
                  echo "<tr><td colspan='6' class='text-center'><i class='fas fa-search'></i> $mensagem</td></tr>";
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

  <!-- Script para focar no campo de pesquisa com Ctrl+K -->
  <script>
    document.addEventListener('keydown', function (e) {
      if (e.ctrlKey && e.key === 'k') {
        e.preventDefault();
        document.querySelector('input[name="search"]').focus();
      }
    });

    // Auto-submit após delay (opcional)
    let searchTimeout;
    document.querySelector('input[name="search"]').addEventListener('input', function () {
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(() => {
        // Uncomment the line below if you want auto-search while typing
        // this.form.submit();
      }, 500);
    });
  </script>

  <footer>Beatriz Coimbra José - TDESN V3</footer>
</body>

</html>