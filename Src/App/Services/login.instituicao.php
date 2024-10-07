<?php
session_start();
require '../database/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = 'SELECT id_instituicao, senha FROM instituicao WHERE email = ?';
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_instituicao, $hashedSenha);
        $stmt->fetch();

        if (password_verify($senha, $hashedSenha)) {
            $_SESSION['id_instituicao'] = $id_instituicao;
            header('Location: ../View/Instituição/instituicao.index.view.php');
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Instituição não encontrada!";
    }

    $stmt->close();
    $conexao->close();
}
?>