<?php
session_start();
require '../database/config.php'; 


if (isset($_SESSION['usuario_id'])) {

    $_SESSION = [];
    
    session_destroy();
    header("Location: ../View/login.view.php"); 
    exit;
} else {
    header("Location: ../View/login.view.php"); 
    exit;
}
?>
