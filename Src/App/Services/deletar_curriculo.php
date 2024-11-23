<?php
session_start();
require '../database/config.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../Views/login.view.php");
    exit();
}

// Verificar se o ID do currículo foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_curriculo'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $id_curriculo = $_POST['id_curriculo'];

    // Preparar a consulta para deletar o currículo
    $query = "DELETE FROM curriculos WHERE id = ? AND id_usuario = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ii", $id_curriculo, $id_usuario);

    if ($stmt->execute()) {
        // Sucesso na exclusão
        $_SESSION['mensagem'] = "Currículo deletado com sucesso.";
    } else {
        // Falha na exclusão
        $_SESSION['mensagem'] = "Erro ao deletar o currículo.";
    }

    $stmt->close();
    $conexao->close();

    // Redirecionar de volta para a página de currículos
    header("Location: ../View/Gerenciar.curriculo.php");
    exit();
} else {
    // Redirecionar se os dados não forem válidos
    header("Location: ../View/Gerenciar.curriculo.php");
    exit();
}
?>
