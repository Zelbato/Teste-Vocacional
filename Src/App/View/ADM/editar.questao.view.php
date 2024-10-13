<?php

session_start();
require '../../database/config.php';

// Verifica se o usuário tem nível de acesso "admin"
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 'admin') {
    header("Location: ../View/login.view.php");
    exit();
}

// Verifica se o ID da questão foi passado
if (!isset($_GET['id'])) {
    die('ID da questão não fornecido.');
}

$question_id = intval($_GET['id']);

// Atualiza o texto da questão
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question_text'])) {
    $question_text = $_POST['question_text'];

    if (!empty($question_text)) {
        // Atualiza o texto da questão no banco de dados
        $stmt = $conexao->prepare("UPDATE questions SET question_text = ? WHERE id = ?");
        $stmt->bind_param("si", $question_text, $question_id);
        $stmt->execute();
    } else {
        echo "O texto da questão não pode estar vazio.";
    }

    // Atualiza as opções da questão
    if (isset($_POST['option_text'])) {
        foreach ($_POST['option_text'] as $option_id => $option_text) {
            if (!empty($option_text)) {
                $stmt = $conexao->prepare("UPDATE options SET option_text = ? WHERE id = ?");
                $stmt->bind_param("si", $option_text, $option_id);
                $stmt->execute();
            }
        }
    }

    // Adiciona uma nova opção, se fornecida
    if (!empty($_POST['new_option_text'])) {
        $new_option_text = $_POST['new_option_text'];
        $carreira_id = intval($_POST['new_option_carreira']); // Supondo que a carreira está sendo escolhida
        $stmt = $conexao->prepare("INSERT INTO options (question_id, option_text, carreira_id) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $question_id, $new_option_text, $carreira_id);
        $stmt->execute();
    }

    // Redireciona após salvar as mudanças
    header("Location: editar_quest.php?id=$question_id");
    exit();
}

// Obtém os dados da questão
$stmt = $conexao->prepare("SELECT question_text FROM questions WHERE id = ?");
$stmt->bind_param("i", $question_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die('Questão não encontrada.');
}

$question = $result->fetch_assoc();

// Obtém as opções associadas a essa questão
$stmt = $conexao->prepare("SELECT id, option_text, carreira_id FROM options WHERE question_id = ?");
$stmt->bind_param("i", $question_id);
$stmt->execute();
$options_result = $stmt->get_result();
$options = $options_result->fetch_all(MYSQLI_ASSOC);

// Obtém todas as carreiras para popular as opções de carreira
$carreira_result = $conexao->query("SELECT id, nome FROM carreira");
$carreiras = $carreira_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Public/assets/styles/ADM/Editarquest/editar.questao.css?v=<?php echo time(); ?>">

    <!--Icones Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Icones Bootstrap-->

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Google Fonts-->

    <title>Editar Questão e Opções</title>
</head>

<body>

    <main class="main">
        <section class="editarQuest">
            <div class="container">
                <h1>Editar Questão</h1>

                <form method="post" action="">

                    <label for="question_text">Texto da Questão:</label>
                    <div class="option-container">
                        <input class="quest" type="text" id="question_text" name="question_text" value="<?php echo htmlspecialchars($question['question_text']); ?>" required>
                    </div>

                    <h2>Opções da Questão</h2>
                    <?php foreach ($options as $option): ?>
                        <div class="option-container">
                            <label for="option<?php echo $option['id']; ?>">Opção:</label>
                            <input type="text" id="option<?php echo $option['id']; ?>" name="option_text[<?php echo $option['id']; ?>]" value="<?php echo htmlspecialchars($option['option_text']); ?>" required>

                            <label for="carreira<?php echo $option['id']; ?>">Carreira Associada:</label>
                            <select id="carreira<?php echo $option['id']; ?>" name="carreira[<?php echo $option['id']; ?>]">
                                <?php foreach ($carreiras as $carreira): ?>
                                    <option value="<?php echo $carreira['id']; ?>" <?php if ($option['carreira_id'] == $carreira['id']) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($carreira['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endforeach; ?>

                    <button type="submit"><a href="gerenciar.questao.view.php">Salvar Alterações</a></button>
                </form>

                <a href="gerenciar.questao.view.php" class="back-link">Voltar para Gerenciar Questões</a>
            </div>
        </section>
    </main>
</body>

</html>