<?php
// index.php
require 'config.php'; // Inclui a configuração do banco de dados

session_start(); // Inicia a sessão


// Carrega todas as questões e opções do banco de dados
$query = "SELECT q.id as question_id, q.question_text, o.id as option_id, o.option_text, o.career 
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
        'text' => $row['option_text'],
        'career' => $row['career']
    ];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teste Vocacional</title>
</head>
<body>
    <h1>Teste Vocacional</h1>
    <form method="post" action="resultado.php">
        <?php foreach ($questions as $question_id => $question): ?>
            <p><?php echo htmlspecialchars($question['text']); ?></p>
            <?php foreach ($question['options'] as $option): ?>
                <input type="radio" id="option<?php echo $option['id']; ?>" name="question<?php echo $question_id; ?>" value="<?php echo $option['career']; ?>" required>
                <label for="option<?php echo $option['id']; ?>"><?php echo htmlspecialchars($option['text']); ?></label><br>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <button type="submit">Enviar Respostas</button>
    </form>
</body>
</html>
