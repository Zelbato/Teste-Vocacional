<?php
require '../database/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $experiencia = $_POST['experiencia'];
    $formacao = $_POST['formacao'];

    $stmt = $conexao->prepare("UPDATE curriculos SET nome = ?, email = ?, telefone = ?, experiencia = ?, formacao = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $nome, $email, $telefone, $experiencia, $formacao, $id);

    if ($stmt->execute()) {
        echo "Currículo atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o currículo: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>
