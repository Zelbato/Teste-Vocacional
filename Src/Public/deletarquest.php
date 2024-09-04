<?php
require "ver_tipo.php";
require 'config.php';

// Obtém todas as questões do banco de dados
$sql = "SELECT id, question_text FROM questions";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Questões</title>
</head>
<body>
    <h1>Gerenciar Questões</h1>

    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Texto da Questão</th>
                <th>Ação</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['question_text']); ?></td>
                    <td>
                        <form method="post" action="deletar_quest.php" onsubmit="return confirm('Tem certeza que deseja excluir esta questão?');">
                            <input type="hidden" name="question_id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Nenhuma questão encontrada.</p>
    <?php endif; ?>

    <a href="criarq.php">Adicionar Nova Questão</a>

    <?php $conexao->close(); ?>
</body>
</html>
