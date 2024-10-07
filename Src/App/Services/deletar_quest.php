<?php

require_once "../database/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_id = $_POST['question_id'];

    // Prepara a instrução SQL para excluir a questão
    $stmt = $conexao->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->bind_param("i", $question_id);

    if ($stmt->execute()) {
        header("Location: ../View/ADM/gerenciar.questao.view.php");
    } else {
        echo "Erro ao excluir a questão: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>
