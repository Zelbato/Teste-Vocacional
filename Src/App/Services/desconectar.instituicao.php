<?php
session_start();
require '../database/config.php'; 


if (isset($_SESSION['id_instituicao'])) {

    $_SESSION = [];
    
    session_destroy();
    header("Location: ../View/login.view.php"); 
    exit;
} else {
    header("Location: ../View/login.view.php"); 
    exit;
}
?>
