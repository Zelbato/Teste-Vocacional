<?php
require_once "/wamp64/www/Teste-Vocacional/Src/App/database/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmSenha = $_POST['confirmSenha'];
    $cep = $_POST['cep'];
    $data_nascimento = $_POST['data_nascimento'];

    if ($senha !== $confirmSenha) {
        echo "As senhas não coincidem!";
        exit();
    }

    $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

    $sql = 'INSERT INTO usuario (name, email, senha, cep, data_nascimento, nivel) VALUES (?, ?, ?, ?, ?, ?)';

    $stmt = $conexao->prepare($sql);
    $nivel = 'user';

    $stmt->bind_param("ssssss", $name, $email, $hashedSenha, $cep, $data_nascimento, $nivel);

    if ($stmt->execute()) {
        echo "Cadastro efetuado com sucesso!";
        
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>
