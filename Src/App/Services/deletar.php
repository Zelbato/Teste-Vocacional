
<?php
session_start();
require_once "../database/config.php";

// Verifica se o ID do usuário ou instituição está na sessão
if (isset($_SESSION['id_usuario']) || isset($_SESSION['id_instituicao'])) {
    // Se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se é um usuário comum
        if (isset($_SESSION['id_usuario'])) {
            $userId = $_SESSION['id_usuario'];

            // Prepara a consulta para excluir o usuário
            $sql = 'DELETE FROM usuario WHERE id_usuario = ?';
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("i", $userId);

            if ($stmt->execute()) {
                echo "Cadastro de usuário excluído com sucesso!";
                session_destroy();  // Destroi a sessão
                header("Location: ../View/cadastro.view.php");  // Redireciona para a página de cadastro de usuários
                exit();
            } else {
                echo "Erro ao excluir o cadastro de usuário: " . $stmt->error;
            }
        }
        // Verifica se é uma instituição
        elseif (isset($_SESSION['id_instituicao'])) {
            $instituicaoId = $_SESSION['id_instituicao'];

            // Prepara a consulta para excluir a instituição
            $sql = 'DELETE FROM instituicao WHERE id_instituicao = ?';
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("i", $instituicaoId);

            if ($stmt->execute()) {
                echo "Cadastro de instituição excluído com sucesso!";
                session_destroy();  // Destroi a sessão
                header("Location: ../View/Instituição/instituicao.cadastro.php"); // Redireciona para a página de cadastro de instituições
                exit();
            } else {
                echo "Erro ao excluir o cadastro de instituição: " . $stmt->error;
            }
        }

        $stmt->close();
    }
} else {
    echo "Erro: Nenhum usuário ou instituição encontrado na sessão.";
}

$conexao->close();
?>
