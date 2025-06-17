<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['mensagem'])):
    $tipo = $_SESSION['tipo'] ?? 'warning'; 
?>
    <div class="alert alert-<?= $tipo ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['mensagem'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    unset($_SESSION['mensagem'], $_SESSION['tipo']);
endif;
?>
