<?php
require_once "../database/config.php";

// Recebe o id_usuario da URL
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
} else {
    echo "ID do usuário não fornecido.";
    exit();
}

// Código para processar a atualização quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cep = $_POST['cep'];
    $data_nascimento = $_POST['data_nascimento'];

    // Validação do CEP (exemplo: deve estar no formato XXXXX-XXX)
    if (!preg_match('/^\d{5}-\d{3}$/', $cep)) {
        echo "O CEP deve estar no formato XXXXX-XXX.";
        exit();
    }

    // Verificar se o CEP já existe na tabela cep
    $sql_cep = 'SELECT id_cep FROM cep WHERE cep_numero = ?';
    $stmt_cep = $conexao->prepare($sql_cep);
    $stmt_cep->bind_param("s", $cep);
    $stmt_cep->execute();
    $result_cep = $stmt_cep->get_result();

    if ($result_cep->num_rows > 0) {
        $row = $result_cep->fetch_assoc();
        $id_cep = $row['id_cep'];
    } else {
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

    // Atualizar informações do usuário
    $sql_update = 'UPDATE usuario SET name = ?, email = ?, senha = ?, id_cep = ?, data_nascimento = ? WHERE id_usuario = ?';
    $stmt_update = $conexao->prepare($sql_update);
    $stmt_update->bind_param("sssssi", $name, $email, $hashedSenha, $id_cep, $data_nascimento, $id_usuario);

    if ($stmt_update->execute()) {
        echo "Usuário atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar usuário: " . $stmt_update->error;
    }

    $stmt_update->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>
    <form method="post">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" pattern="\d{5}-\d{3}" title="Formato: XXXXX-XXX" required><br><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br><br>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
