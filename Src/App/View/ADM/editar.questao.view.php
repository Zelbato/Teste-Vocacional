<?php
session_start();
require '../../database/config.php';

// Verifica se o usuário tem nível de acesso 'admin'
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 'admin') {
    header("Location: ../View/login.view.php");
    exit();
}

// Verifica se o ID da questão foi passado
if (!isset($_GET['id'])) {
    die('ID da questão não fornecido.');
}

$question_id = intval($_GET['id']);

// Atualiza a questão e suas opções
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question_text'])) {
    $question_text = $_POST['question_text'];

    // Atualiza o texto da questão
    if (!empty($question_text)) {
        $stmt = $conexao->prepare("UPDATE questions SET question_text = ? WHERE id = ?");
        $stmt->bind_param("si", $question_text, $question_id);
        $stmt->execute();
    } else {
        echo "O texto da questão não pode estar vazio.";
    }

    // Atualiza as opções e as carreiras associadas
    if (isset($_POST['option_text']) && isset($_POST['carreira'])) {
        foreach ($_POST['option_text'] as $option_id => $option_text) {
            $carreira_id = $_POST['carreira'][$option_id];

            if (!empty($option_text) && !empty($carreira_id)) {
                $stmt = $conexao->prepare(
                    "UPDATE options SET option_text = ?, carreira_id = ? WHERE id = ?"
                );
                $stmt->bind_param("sii", $option_text, $carreira_id, $option_id);
                $stmt->execute();
            }
        }
    }

    // Redireciona após salvar as alterações
    header("Location: editar_quest.php?id=$question_id");
    exit();
}

// Obtém o texto da questão
$stmt = $conexao->prepare("SELECT question_text FROM questions WHERE id = ?");
$stmt->bind_param("i", $question_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die('Questão não encontrada.');
}

$question = $result->fetch_assoc();

// Obtém as opções associadas à questão
$stmt = $conexao->prepare("SELECT id, option_text, carreira_id FROM options WHERE question_id = ?");
$stmt->bind_param("i", $question_id);
$stmt->execute();
$options_result = $stmt->get_result();
$options = $options_result->fetch_all(MYSQLI_ASSOC);

// Obtém todas as carreiras para o select
$carreira_result = $conexao->query("SELECT id, nome FROM carreira");
$carreiras = $carreira_result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Public/assets/styles/ADM/Editarquest/editar.questao.css?v=<?php echo time(); ?>">
    <title>Editar Questão e Opções</title>
</head>

<body>
    <main class="main">
        <section class="editarQuest">
            <div class="container">
                <h1>Editar Questão</h1>

                <form method="post" action="">
                    <label for="question_text">Texto da Questão:</label>
                    <input type="text" id="question_text" name="question_text" 
                           value="<?php echo htmlspecialchars($question['question_text']); ?>" required>

                    <h2>Opções da Questão</h2>
                    <?php foreach ($options as $option): ?>
                        <div class="option-container">
                            <label for="option<?php echo $option['id']; ?>">Opção:</label>
                            <input type="text" id="option<?php echo $option['id']; ?>" 
                                   name="option_text[<?php echo $option['id']; ?>]" 
                                   value="<?php echo htmlspecialchars($option['option_text']); ?>" required>

                            <label for="carreira<?php echo $option['id']; ?>">Carreira Associada:</label>
                            <select id="carreira<?php echo $option['id']; ?>" 
                                    name="carreira[<?php echo $option['id']; ?>]">
                                <?php foreach ($carreiras as $carreira): ?>
                                    <option value="<?php echo $carreira['id']; ?>" 
                                        <?php if ($option['carreira_id'] == $carreira['id']) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($carreira['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endforeach; ?>

                    <button type="submit">Salvar Alterações</button>
                </form>

                <a href="gerenciar.questao.view.php" class="back-link">Voltar para Gerenciar Questões</a>
            </div>
        </section>
    </main>
</body>

</html>
