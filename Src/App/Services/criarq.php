<?php
require "ver_tipo.php";
require_once "/wamp64/www/Teste-Vocacional/Src/App/database/config.php";


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



