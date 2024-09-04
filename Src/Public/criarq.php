<?php
require "ver_tipo.php";
require 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_text = $_POST['question_text'];
    $options = $_POST['options'];

    // Prepara a instrução SQL para inserir uma nova questão
    $stmt = $conexao ->prepare("INSERT INTO questions (question_text) VALUES (?)");
    $stmt->bind_param("s", $question_text);
    $stmt->execute();
    $question_id = $conexao->insert_id; 

    // Adiciona as opções para a questão
    foreach ($options as $option) {
        $stmt = $conexao->prepare("INSERT INTO options (question_id, option_text, career) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $question_id, $option['text'], $option['career']);
        $stmt->execute();
    }

    echo "Questão e opções adicionadas com sucesso!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administração de Questões</title>
</head>
<body>
    <h1>Adicionar Questão</h1>
    <form method="post" action="">
        <label for="question_text">Texto da Questão:</label>
        <input type="text" id="question_text" name="question_text" required><br>
        <div id="options">
            <!-- Div para opções -->
        </div>
        <button type="button" onclick="addOption()">Adicionar Opção</button><br>
        <button type="submit">Salvar Questão</button>
    </form>
    <script>
        let optionCount = 1;
        function addOption() {
            const optionsDiv = document.getElementById('options');
            const newOptionDiv = document.createElement('div');
            newOptionDiv.innerHTML = `<input type="text" name="options[${optionCount}][text]" placeholder="Texto da opção" required>
                                      <select name="options[${optionCount}][career]" required>
                                          <option value="math_teacher">Professor de Matemática</option>
                                          <option value="lawyer">Advogado</option>
                                          <option value="programmer">Programador</option>
                                      </select>`;
            optionsDiv.appendChild(newOptionDiv);
            optionCount++;
        }
    </script>
</body>
</html>
