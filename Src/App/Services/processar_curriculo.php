<?php
require '../database/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $experiencia = $_POST['experiencia'];
    $formacao = $_POST['formacao'];

    $stmt = $conexao->prepare("INSERT INTO curriculos (nome, email, telefone, experiencia, formacao) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $email, $telefone, $experiencia, $formacao);

    if ($stmt->execute()) {
        echo "Currículo salvo com sucesso!";
    } else {
        echo "Erro ao salvar o currículo: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>
