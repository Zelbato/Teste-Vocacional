<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['id_usuario']; 

    $sql = 'DELETE FROM usuario WHERE id_usuario = ?';

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "Cadastro excluído com sucesso!";
        session_destroy();
        header("Location: tela_cadastro.php"); // Redireciona para a página de cadastro pois ele tem q se cadastrar novamente 
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cadastro</title>
</head>
<body>
    <h2>Excluir Cadastro</h2>
    <p>Tem certeza que deseja excluir seu cadastro? Esta ação não pode ser desfeita.</p>
    <form action="deletar.php" method="post">
        <button type="submit">Excluir</button>
        <a href="paginaP.php">Cancelar</a> <!-- Link para a pagina principal-->
    </form>
</body>
</html>
