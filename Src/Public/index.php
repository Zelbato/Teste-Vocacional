<?php
// public/index.php

// Inclui a conexão com o banco (caminho relativo da pasta public para app/DADOS)
require_once '../App/database/config.php';

// Cabeçalho e rodapé (opcional)
// include '../app/views/includes/header.php';

// Pega o valor da página
$page = isset($_GET['page']) ? $_GET['page'] : 'login.view';

// Caminho completo do arquivo na pasta views
$file = '../App/View/' . $page . '.php';

// Inclui o arquivo se existir
if (file_exists($file)) {
    include $file;
} else {
    echo "<h1>Página não encontrada!</h1>";
}

// include '../app/views/includes/footer.php';
?>
