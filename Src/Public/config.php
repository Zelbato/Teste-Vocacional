<?php
$host = 'Localhost';
$port = '3306';
$userName = 'root';
$passoword = '';
$dbName = 'cadastro';

$conexao = new mysqli($host, $userName, $passoword, $dbName);

if($conexao->connect_errno){
  echo "falha ao conect ar: (" . $conexao->connect_errno . ")" . $conexao->connect_errno;
}else{
    echo "Conexão efetuada com sucesso";
}
?>

