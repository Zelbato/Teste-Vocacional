<?php
session_start();
require '../database/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id_usuario'];

    // Para contabilizar a quantidade de opções selecionadas para cada carreira
    $career_count = [];

    foreach ($_POST as $question_id => $option_id) {
        $option_id = intval($option_id);

        // Obtém a carreira associada a essa opção
        $stmt = $conexao->prepare("SELECT carreira_id FROM options WHERE id = ?");
        $stmt->bind_param("i", $option_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $career_id = $row['carreira_id'];

        // Armazena a resposta do usuário
        $stmt = $conexao->prepare("INSERT INTO user_responses (user_id, question_id, option_id, carreira_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiii", $user_id, $question_id, $option_id, $career_id);
        $stmt->execute();

        // Conta quantas vezes essa carreira foi selecionada
        if (!isset($career_count[$career_id])) {
            $career_count[$career_id] = 0;
        }
        $career_count[$career_id]++;
    }

    // Determina a carreira mais escolhida
    arsort($career_count); // Ordena de forma decrescente
    $suggested_career = key($career_count); // Carreira com mais respostas

    // Redireciona para a página de resultado, passando a carreira sugerida
    header("Location: P1result.view.php?carreira_id=$suggested_career");
    exit();
}

// Carrega questões e opções
$query = "SELECT q.id as question_id, q.question_text, o.id as option_id, o.option_text, o.carreira_id 
          FROM questions q 
          LEFT JOIN options o ON q.id = o.question_id 
          ORDER BY q.id, o.id";
$result = $conexao->query($query);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $question_id = $row['question_id'];
    if (!isset($questions[$question_id])) {
        $questions[$question_id] = [
            'text' => $row['question_text'],
            'options' => []
        ];
    }
    $questions[$question_id]['options'][] = [
        'id' => $row['option_id'],
        'text' => $row['option_text']
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Vocacional</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .question {
            display: none;
        }
        .active {
            display: block;
        }
        .options label {
            display: block;
            margin-bottom: 10px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a4d8f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #1e3667;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Teste Vocacional</h1>
    <form id="quizForm" method="POST" action="">
        <?php foreach ($questions as $question_id => $question): ?>
            <div class="question" id="question-<?php echo $question_id; ?>">
                <p><?php echo htmlspecialchars($question['text']); ?></p>
                <div class="options">
                    <?php foreach ($question['options'] as $option): ?>
                        <input type="radio" id="option<?php echo $option['id']; ?>" name="<?php echo $question_id; ?>" value="<?php echo $option['id']; ?>" required>
                        <label for="option<?php echo $option['id']; ?>"><?php echo htmlspecialchars($option['text']); ?></label>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="button" class="btn" id="nextBtn" onclick="showNextQuestion()">Próxima</button>
        <button type="submit" class="btn" id="submitBtn" style="display:none;">Enviar Respostas</button>
    </form>
</div>

<script>
    let currentQuestion = 0;
    const questions = document.querySelectorAll('.question');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');

    // Mostrar a primeira pergunta
    questions[currentQuestion].classList.add('active');

    function showNextQuestion() {
        // Verifica se alguma opção foi selecionada
        const selectedOption = questions[currentQuestion].querySelector('input[type="radio"]:checked');
        if (!selectedOption) {
            alert('Por favor, selecione uma opção.');
            return;
        }

        // Oculta a pergunta atual
        questions[currentQuestion].classList.remove('active');
        currentQuestion++;

        // Verifica se ainda há mais perguntas
        if (currentQuestion < questions.length) {
            questions[currentQuestion].classList.add('active');
        } else {
            // Oculta o botão "Próxima" e mostra o botão "Enviar"
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'inline-block';
        }
    }
</script>

</body>
</html>