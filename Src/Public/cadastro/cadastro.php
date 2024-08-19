<?php

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmSenha= $_POST['confirmSenha'];
    $cep = $_POST['cep'];
    $data_nascimento = $_POST['data_nascimento'];

  //   $cadEstudante = $_POST['cadEstudante'];
  //  $cadProfissional = $_POST['cadProfissional'];
   
  if ($senha !== $confirmSenha) {
    echo "As senhas não coincidem!";
    exit();
}
$senha = password_hash($senha, PASSWORD_DEFAULT);

$sql  = 'INSERT INTO usuario (name,email,senha,confirmSenha,cep,data_nascimento,nivel) VALUES (?,?,?,?,?,?,?)';

$stmt = $conexao->prepare($sql);
$nivel = 'user';

$stmt->bind_param("sssssss", $name,$email,$senha,$confirmSenha,$cep,$data_nascimento,$nivel);


$stmt->execute();

$stmt -> close();

$conexao-> close();

}
?>

