<?php
require '../database/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_fantasia = $_POST['nome_fantasia'];
    $cep = $_POST['cep'];
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $razao_social = $_POST['razao_social'];
    $url = $_POST['url']; // Novo campo

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

    // Inserir os dados na tabela `instituicao`
    $stmt = $conexao->prepare("INSERT INTO instituicao (nome_fantasia, id_cep, cnpj, email, senha, url, razao_social) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssss", $nome_fantasia, $id_cep, $cnpj, $email, $hashedSenha, $url, $razao_social);

    if ($stmt->execute()) {
        header('Location: ../View/Instituição/instituicao.login.view.php');
    } else {
        echo "Erro ao cadastrar a instituição: " . $stmt->error;
    }

    

    $stmt->close();
    $conexao->close();
}
?>