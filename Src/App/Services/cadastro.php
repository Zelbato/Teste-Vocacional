<?php
require_once "../database/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cep = $_POST['cep'];
    $data_nascimento = $_POST['data_nascimento'];

    // Validação do CEP (exemplo: deve estar no formato XXXXX-XXX)
    if (!preg_match('/^\d{5}-\d{3}$/', $cep)) {
        echo "O CEP deve ser no formato XXXXX-XXX.";
        exit();
    }

    // Verificar se o CEP já existe na tabela cep
    $sql_cep = 'SELECT id_cep FROM cep WHERE cep_numero = ?';
    $stmt_cep = $conexao->prepare($sql_cep);
    $stmt_cep->bind_param("s", $cep);
    $stmt_cep->execute();
    $result_cep = $stmt_cep->get_result();

    if ($result_cep->num_rows > 0) {
        // Se o CEP já existir, obtenha o id_cep
        $row = $result_cep->fetch_assoc();
        $id_cep = $row['id_cep'];
    } else {
        // Se o CEP não existir, insira o novo CEP
        $sql_insert_cep = 'INSERT INTO cep (cep_numero) VALUES (?)';
        $stmt_insert_cep = $conexao->prepare($sql_insert_cep);
        $stmt_insert_cep->bind_param("s", $cep);
        if ($stmt_insert_cep->execute()) {
            $id_cep = $stmt_insert_cep->insert_id;
        } else {
            echo "Erro ao inserir o CEP: " . $stmt_insert_cep->error;
            exit();
        }
        $stmt_insert_cep->close();
    }

    $stmt_cep->close();

    $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir o usuário com o id_cep obtido
    $sql_usuario = 'INSERT INTO usuario (name, email, senha, id_cep, data_nascimento, nivel) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt_usuario = $conexao->prepare($sql_usuario);
    $nivel = 'user';
    $stmt_usuario->bind_param("ssssss", $name, $email, $hashedSenha, $id_cep, $data_nascimento, $nivel);

    if ($stmt_usuario->execute()) {
        header('Location: ../View/login.view.php');
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt_usuario->error;
    }

   

    $stmt_usuario->close();
    $conexao->close();
}
?>
