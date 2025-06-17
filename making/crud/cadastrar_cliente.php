<?php
// Inicia a sessão
session_start();

// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Verifica se o formulário foi enviado
if (isset($_POST['create_cliente'])) {

  // Recebe os dados do formulário
  $nome_cliente = mysqli_real_escape_string($conexao, trim($_POST['nome']));
  $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
  $telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
  $endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));

  // Verifica se algum dos campos está vazio
  if (empty($nome_cliente) || empty($email) || empty($telefone) || empty($endereco)) {
    $_SESSION['message'] = "Todos os campos são obrigatórios!";
    $_SESSION['message_type'] = "danger";
  } else {
    // Verifica se o email já existe no banco
    // CORREÇÃO: Usar o nome da coluna correta (substitua 'id_cliente' pelo nome real da sua chave primária)
    $check_email = "SELECT id_cliente FROM cliente WHERE email = '$email'";
    $result = mysqli_query($conexao, $check_email);
    
    if (mysqli_num_rows($result) > 0) {
      $_SESSION['message'] = "Este email já está cadastrado no sistema!";
      $_SESSION['message_type'] = "warning";
    } else {
      // Cria a query SQL para inserir um novo cliente
      $sql = "INSERT INTO cliente (nome_cliente, email, telefone, endereco) 
                  VALUES ('$nome_cliente', '$email', '$telefone', '$endereco')";

      // Executa a query no banco
      if (mysqli_query($conexao, $sql)) {
        $_SESSION['message'] = "Cliente cadastrado com sucesso!";
        $_SESSION['message_type'] = "success";

        // Redireciona para limpar o POST e evitar reenvio
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
      } else {
        $_SESSION['message'] = "Erro ao cadastrar cliente: " . mysqli_error($conexao);
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
  <title>Adicionar Usuário</title>
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
            <h4>Adicionar usuário
              <a href="buscar_cliente.php" class="btn btn-danger float-end">Voltar</a>
            </h4>
          </div>
          <div class="card-body">
          
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="clienteForm">
              <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required maxlength="50">
                <div class="invalid-feedback">
                  Nome deve conter apenas letras
                </div>
              </div>
              <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
                <div class="invalid-feedback">
                  Digite um email válido
                </div>
              </div>
              <div class="mb-3">
                <label>Telefone</label>
                <input type="tel" name="telefone" id="telefone" class="form-control" required placeholder="(12) 3456-7890">
                <div class="invalid-feedback">
                  Digite um telefone válido
                </div>
              </div>
              <div class="mb-3">
                <label>Endereço</label>
                <input type="text" name="endereco" id="endereco" class="form-control" required maxlength="100">
                <div class="invalid-feedback">
                  Endereço deve conter apenas letras, números e hífen
                </div>
              </div>
              <div class="mb-3">
                <button type="submit" name="create_cliente" class="btn btn-primary">Salvar</button>
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

      // Máscara para Telefone - formato (XX) XXXX-XXXX - CORRIGIDA
      telefoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
        
        // Limita a 10 dígitos (2 para área + 8 para número)
        if (value.length > 10) {
          value = value.slice(0, 10);
        }
        
        // Aplica a formatação baseada na quantidade de dígitos
        if (value.length === 0) {
          value = '';
        } else if (value.length <= 2) {
          value = `(${value}`;
        } else if (value.length <= 6) {
          value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
        } else if (value.length <= 10) {
          value = `(${value.slice(0, 2)}) ${value.slice(2, 6)}-${value.slice(6)}`;
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
        const telefoneRegex = /^\(\d{2}\) \d{4}-\d{4}$/;
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