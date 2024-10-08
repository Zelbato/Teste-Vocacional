<?php
require '../database/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $experiencia = $_POST['experiencia'];
    $formacao = $_POST['formacao'];
    $habilidades = $_POST['habilidades'];

    // Verifica se um novo arquivo de foto foi enviado
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == UPLOAD_ERR_OK) {
        // Processa o upload da foto
        $foto_perfil = 'uploads/' . basename($_FILES['foto_perfil']['name']);
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $foto_perfil);
    } else {
        // Mantém a foto atual caso não tenha sido enviada uma nova
        $stmt = $conexao->prepare("SELECT foto_perfil FROM curriculos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $curriculo = $result->fetch_assoc();
        $foto_perfil = $curriculo['foto_perfil'];
        $stmt->close();
    }

    // Atualiza o currículo com os novos dados
    $stmt = $conexao->prepare("UPDATE curriculos SET nome = ?, email = ?, telefone = ?, endereco = ?, experiencia = ?, formacao = ?, habilidades = ?, foto_perfil = ? WHERE id = ?");
    $stmt->bind_param("ssssssssi", $nome, $email, $telefone, $endereco, $experiencia, $formacao, $habilidades, $foto_perfil, $id);

    if ($stmt->execute()) {
       header('Location: ../View/Gerenciar.curriculo.php');

    } else {
        echo "Erro ao atualizar o currículo: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>