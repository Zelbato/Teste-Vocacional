<!-- <?php
session_start(); 
//Verifica se o usuário é administrador
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] != "admin") {
    header('Location: login.php');
    exit;
 }

?>