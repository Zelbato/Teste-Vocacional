<?php

include("../config.php");

require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmSenha= $_POST['confirmSenha'];
    $cep = $_POST['cep'];
    $data_nascimento = $_POST['data_nascimento'];

  //   $cadEstudante = $_POST['cadEstudante'];
  //  $cadProfissional = $_POST['cadProfissional'];
   
}

$sql = "INSERT INTO cadastrar (name,email,senha,confirmSenha,cep,data_nascimento) VALUES (?,?,?,?,?,?)";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssssss", $name, $email, $senha,$confirmSenha, $cep, $data_nascimento);
$stmt->execute();




$stmt -> close();
$conexao-> close();
?>

