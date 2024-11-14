<?php

// Verifica se o usuário está logado e possui uma sessão válida
if ($_SESSION['nivel'] === 'user') {
    $user_id = $_SESSION['id_usuario'];
} else if ($_SESSION['nivel'] === 'admin') {
    header("Location: ../View/ADM/adm.view.php");
    exit(); // Para o script após o redirecionamento
} else if (isset($_SESSION['id_instituicao']) && !empty($_SESSION['id_instituicao'])) {
    header('Location: ../View/Instituição/instituicao.index.view.php');
    exit(); // Para o script após o redirecionamento
}


// Se o usuário for um usuário comum, ele não será redirecionado e poderá continuar na página principal
?>