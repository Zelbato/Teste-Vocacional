<?php

include("config.php");

require_once "config.php";
require_once "login.php"
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $stmt = $conexao->prepare("SELECT * FROM usuario WHERE name = ? AND email = ?");
    $stmt->execute([$name, $email]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC); // essa variavel irá ajudar a verificar se os dados do usuario estão correto ou não 

    if ($usuario password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id_usuario'];
        $_SESSION['usuario_name'] = $usuario['name'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['nivel'] = $usuario['nivel']
        header("Location: paginaP.php");//tela principal
        exit();
    } else {
       
        echo "algum dado está errado";
    }
} 
// Fecha a conexão
$stmt->close();
$conexao->close();


?>