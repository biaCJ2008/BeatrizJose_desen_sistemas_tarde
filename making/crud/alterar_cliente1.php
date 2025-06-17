<?php
session_start();
require_once 'conexao.php';

// Variáveis para pré-preenchimento do formulário
$cliente_data = null;

// Busca dados do cliente se ID foi fornecido via GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $id_cliente = mysqli_real_escape_string($conexao, $_GET['id']);
  $sql = "SELECT * FROM cliente WHERE id_cliente = '$id_cliente'";
  $result = mysqli_query($conexao, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $cliente_data = mysqli_fetch_assoc($result);
  }
}

// Verifica se o formulário de atualização de cliente foi enviado
if (isset($_POST['update_cliente'])) {
  $id_cliente = mysqli_real_escape_string($conexao, trim($_POST['id_cliente']));

  // Recebe os dados do formulário, aplica trim() para remover espaços
  // e escapa os caracteres especiais para evitar injeção de SQL
  $nome_cliente = mysqli_real_escape_string($conexao, trim($_POST['nome']));
  $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
  $telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
  $endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));

  // Verifica se algum dos campos está vazio (incluindo o ID)
  if (empty($id_cliente) || empty($nome_cliente) || empty($email) || empty($telefone) || empty($endereco)) {
    // Armazena mensagem de erro na sessão para exibir na próxima página
    $_SESSION['message'] = "Todos os campos são obrigatórios!";
    $_SESSION['message_type'] = "danger"; // Define o tipo para a classe do Bootstrap (alert-danger)
  } else {
    // Verifica se o email já existe para outro cliente
    $check_email = "SELECT id_cliente FROM cliente WHERE email = '$email' AND id_cliente != '$id_cliente'";
    $result = mysqli_query($conexao, $check_email);
    
    if (mysqli_num_rows($result) > 0) {
      $_SESSION['message'] = "Este email já está cadastrado para outro cliente!";
      $_SESSION['message_type'] = "warning";
    } else {
      // Cria a query SQL para atualizar o cliente no banco
      $sql = "UPDATE cliente SET 
                      nome_cliente = '$nome_cliente', 
                      email = '$email', 
                      telefone = '$telefone', 
                      endereco = '$endereco' 
                  WHERE id_cliente = '$id_cliente'";

      // Executa a query no banco
      if (mysqli_query($conexao, $sql)) {
        // Verifica se alguma linha foi realmente afetada
        if (mysqli_affected_rows($conexao) > 0) {
          // Se deu certo, armazena mensagem de sucesso na sessão
          $_SESSION['message'] = "Cliente atualizado com sucesso!";
          $_SESSION['message_type'] = "success"; // Para exibir alerta verde (Bootstrap)
        } else {
          // Nenhuma linha foi alterada (dados idênticos ou ID não existe)
          $_SESSION['message'] = "Nenhuma alteração foi realizada. Verifique se o ID existe e se os dados são diferentes.";
          $_SESSION['message_type'] = "warning"; // Para exibir alerta amarelo (Bootstrap)
        }

        // Redireciona para a mesma página SEM parâmetros para limpar o formulário
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id_cliente);
        exit(); // Encerra o script após o redirecionamento
      } else {
        // Se deu erro na query, exibe mensagem de erro com detalhe
        $_SESSION['message'] = "Erro ao atualizar cliente: " . mysqli_error($conexao);
        $_SESSION['message_type'] = "danger";
      }
    }
  }
}
?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="footer.css">
</head>

<body>
  <?php include('navbar.php'); ?>

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
            <h4>Editar Cliente
              <a href="alterar_cliente.php" class="btn btn-danger float-end">Voltar</a>
            </h4>
          </div>
          <div class="card-body">
            <form action="<?= $_SERVER['PHP_SELF'] ?><?= $cliente_data ? '?id=' . $cliente_data['id_cliente'] : '' ?>"
              method="POST" id="clienteForm">
              <!-- Campo ID oculto -->
              <input type="hidden" name="id_cliente" value="<?= $cliente_data ? $cliente_data['id_cliente'] : '' ?>"
                required>
              <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" id="nome" class="form-control"
                  value="<?= $cliente_data ? htmlspecialchars($cliente_data['nome_cliente']) : '' ?>" required maxlength="50">
                <div class="invalid-feedback">
                  Nome deve conter apenas letras
                </div>
              </div>
              <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control"
                  value="<?= $cliente_data ? htmlspecialchars($cliente_data['email']) : '' ?>" required>
                <div class="invalid-feedback">
                  Digite um email válido
                </div>
              </div>
              <div class="mb-3">
                <label>Telefone</label>
                <input type="tel" name="telefone" id="telefone" class="form-control"
                  value="<?= $cliente_data ? htmlspecialchars($cliente_data['telefone']) : '' ?>" required placeholder="(11) 1111-1111">
                <div class="invalid-feedback">
                  Digite um telefone válido
                </div>
              </div>
              <div class="mb-3">
                <label>Endereço</label>
                <input type="text" name="endereco" id="endereco" class="form-control"
                  value="<?= $cliente_data ? htmlspecialchars($cliente_data['endereco']) : '' ?>" required maxlength="100">
                <div class="invalid-feedback">
                  Endereço deve conter apenas letras, números e hífen
                </div>
              </div>
              <div class="mb-3">
                <button onclick="return confirm('Tem certeza que deseja atualizar este cliente?')" type="submit"
                  name="update_cliente" class="btn btn-primary">Atualizar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const nomeInput = document.getElementById('nome');
      const emailInput = document.getElementById('email');
      const telefoneInput = document.getElementById('telefone');
      const enderecoInput = document.getElementById('endereco');
      const form = document.getElementById('clienteForm');

      // Aplica máscara no telefone logo no carregamento da página se já houver valor
      if (telefoneInput.value && telefoneInput.value.replace(/\D/g, '').length === 10) {
        const digits = telefoneInput.value.replace(/\D/g, '');
        telefoneInput.value = `(${digits.substr(0,2)}) ${digits.substr(2,4)}-${digits.substr(6,4)}`;
      }

      // Máscara para Nome - apenas letras e primeira letra de cada palavra maiúscula
      nomeInput.addEventListener('input', function(e) {
        let value = e.target.value;
        
        // Remove qualquer coisa que não seja letra ou espaço
        value = value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');
        
        // Aplica a regra de maiúscula para primeira letra de cada palavra
        if (value.length > 0) {
          let words = value.split(' ');
          words = words.map(word => {
            if (word.length > 0) {
              let firstChar = word.charAt(0).toUpperCase();
              let rest = word.length > 1 ? word.substring(1).toLowerCase() : '';
              return firstChar + rest;
            }
            return word;
          });
          value = words.join(' ');
        }
        
        e.target.value = value;
      });

      // Máscara para Email - formato padrão sem caracteres especiais
      emailInput.addEventListener('input', function(e) {
        let value = e.target.value;
        
        // Remove caracteres especiais, mantém apenas letras, números, @ e .
        value = value.replace(/[^a-zA-Z0-9@._-]/g, '');
        
        e.target.value = value;
      });

      // Máscara para Telefone - formato (XX) XXXX-XXXX
      telefoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
        
        if (value.length <= 10) {
          if (value.length <= 2) {
            value = value.replace(/(\d{0,2})/, '($1');
          } else if (value.length <= 6) {
            value = value.replace(/(\d{2})(\d{0,4})/, '($1) $2');
          } else {
            value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
          }
        }
        
        e.target.value = value;
      });

      // Máscara para Endereço - apenas letras, números, espaços e hífen
      enderecoInput.addEventListener('input', function(e) {
        let value = e.target.value;
        
        // Remove caracteres especiais, mantém apenas letras, números, espaços e hífen
        value = value.replace(/[^a-zA-Z0-9À-ÿ\s\-]/g, '');
        
        e.target.value = value;
      });

      // Validação no envio do formulário
      form.addEventListener('submit', function(e) {
        let isValid = true;

        // Validar nome
        const nomeRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
        if (!nomeRegex.test(nomeInput.value.trim()) || nomeInput.value.trim().length < 2) {
          nomeInput.classList.add('is-invalid');
          isValid = false;
        } else {
          nomeInput.classList.remove('is-invalid');
          nomeInput.classList.add('is-valid');
        }

        // Validar email
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(emailInput.value.trim())) {
          emailInput.classList.add('is-invalid');
          isValid = false;
        } else {
          emailInput.classList.remove('is-invalid');
          emailInput.classList.add('is-valid');
        }

        // Validar telefone
        const telefoneRegex = /^\(\d{2}\)\s\d{4}-\d{4}$/;
        if (!telefoneRegex.test(telefoneInput.value.trim())) {
          telefoneInput.classList.add('is-invalid');
          isValid = false;
        } else {
          telefoneInput.classList.remove('is-invalid');
          telefoneInput.classList.add('is-valid');
        }

        // Validar endereço
        const enderecoRegex = /^[a-zA-Z0-9À-ÿ\s\-]+$/;
        if (!enderecoRegex.test(enderecoInput.value.trim()) || enderecoInput.value.trim().length < 5) {
          enderecoInput.classList.add('is-invalid');
          isValid = false;
        } else {
          enderecoInput.classList.remove('is-invalid');
          enderecoInput.classList.add('is-valid');
        }

        if (!isValid) {
          e.preventDefault();
        }
      });

      // Feedback visual em tempo real
      [nomeInput, emailInput, telefoneInput, enderecoInput].forEach(input => {
        input.addEventListener('blur', function() {
          this.dispatchEvent(new Event('input'));
        });
      });
    });
  </script>

  <footer>Beatriz Coimbra José - TDESN V3</footer>
</body>

</html>