<?php
session_start();


if (isset($_SESSION['id_usuario'])) {
    session_destroy();
    header("Location: ../login.view.php"); 
    exit();
} elseif (isset($_SESSION['id_instituicao'])) {
    session_destroy();
    header("Location: ../Instituição/instituicao.login.view.php"); 
    exit();
}else {

    if (isset($_SESSION['id_usuario'])) {
        header("Location: ../login.view.php"); 
        exit();
    } elseif (isset($_SESSION['id_instituicao'])) {
        header("Location: ../Instituição/instituicao.login.view.php"); 
        exit();
    }
    
}
?>