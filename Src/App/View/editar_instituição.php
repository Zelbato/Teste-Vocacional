<?php
require '../database/config.php';

// Recebe o id_instituicao da URL
if (isset($_GET['id_instituicao'])) {
    $id_instituicao = $_GET['id_instituicao'];
} else {
    echo "ID da instituição não fornecido.";
    exit();
}

// Código para processar a atualização quando o formulário é enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_fantasia = $_POST['nome_fantasia'];
    $cep = $_POST['cep'];
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $razao_social = $_POST['razao_social'];
    $url = $_POST['url'];

    // Validação do CEP (exemplo: deve estar no formato XXXXX-XXX)
    if (!preg_match('/^\d{5}-\d{3}$/', $cep)) {
        echo "O CEP deve estar no formato XXXXX-XXX.";
        exit();
    }

    // Validação do CNPJ (exemplo: deve ter 14 dígitos)
    if (!preg_match('/^\d{14}$/', $cnpj)) {
        echo "O CNPJ deve conter 14 dígitos.";
        exit();
    }

    $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

    // Verificar se o CEP já existe na tabela `cep`
    $stmt = $conexao->prepare("SELECT id_cep FROM cep WHERE cep_numero = ?");
    $stmt->bind_param("s", $cep);
    $stmt->execute();
    $stmt->bind_result($id_cep);
    $stmt->fetch();
    $stmt->close();

    // Se o CEP não existir, insira-o
    if (empty($id_cep)) {
        $stmt = $conexao->prepare("INSERT INTO cep (cep_numero) VALUES (?)");
        $stmt->bind_param("s", $cep);
        if ($stmt->execute()) {
            $id_cep = $conexao->insert_id;
        }
        $stmt->close();
    }

    // Atualizar os dados da instituição na tabela `instituicao`
    $stmt = $conexao->prepare("UPDATE instituicao SET nome_fantasia = ?, id_cep = ?, cnpj = ?, email = ?, senha = ?, url = ?, razao_social = ? WHERE id_instituicao = ?");
    $stmt->bind_param("sisssssi", $nome_fantasia, $id_cep, $cnpj, $email, $hashedSenha, $url, $razao_social, $id_instituicao);

    if ($stmt->execute()) {
        header('Location: ../View/Instituição/instituicao.login.view.php');
    } else {
        echo "Erro ao atualizar a instituição: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Instituição</title>
</head>
<body>
    <h1>Editar Instituição</h1>
    <form method="post">
        <label for="nome_fantasia">Nome Fantasia:</label>
        <input type="text" id="nome_fantasia" name="nome_fantasia" required><br><br>

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" pattern="\d{5}-\d{3}" title="Formato: XXXXX-XXX" required><br><br>

        <label for="cnpj">CNPJ:</label>
        <input type="text" id="cnpj" name="cnpj" pattern="\d{14}" title="Deve conter 14 dígitos" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <label for="razao_social">Razão Social:</label>
        <input type="text" id="razao_social" name="razao_social" required><br><br>

        <label for="url">URL:</label>
        <input type="url" id="url" name="url" required><br><br>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
