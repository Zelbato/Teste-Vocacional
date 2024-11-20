<?php
require '../database/config.php';

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.view.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $experiencia = $_POST['experiencia'];
    $formacao = $_POST['formacao'];
    $habilidades = $_POST['habilidades'];

    // Caminho absoluto para o diretório 'uploads' na raiz do projeto
    $upload_dir = __DIR__ . '../../../../uploads/';

    // Verifica se o diretório para salvar as imagens existe, se não, cria
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Verifica se um novo arquivo de foto foi enviado
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $nome_imagem = uniqid('', true) . '-' . basename($_FILES['foto_perfil']['name']);
        $foto_perfil = '../../../uploads/' . $nome_imagem;

        // Move a imagem para o diretório de uploads
        if (!move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $upload_dir . $nome_imagem)) {
            echo "Erro ao enviar a foto.";
            exit();
        }
    } else {
        // Mantém a foto atual caso não tenha sido enviada uma nova
        $stmt = $conexao->prepare("SELECT foto_perfil FROM curriculos WHERE id = ? AND id_usuario = ?");
        $stmt->bind_param("ii", $id, $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $curriculo = $result->fetch_assoc();

        if ($curriculo) {
            $foto_perfil = $curriculo['foto_perfil'];
        } else {
            echo "Currículo não encontrado ou você não tem permissão para editá-lo.";
            exit();
        }
        $stmt->close();
    }

    // Atualiza o currículo com os novos dados
    $stmt = $conexao->prepare("
        UPDATE curriculos 
        SET nome = ?, email = ?, telefone = ?, endereco = ?, experiencia = ?, formacao = ?, habilidades = ?, foto_perfil = ? 
        WHERE id = ? AND id_usuario = ?
    ");
    $stmt->bind_param("ssssssssii", $nome, $email, $telefone, $endereco, $experiencia, $formacao, $habilidades, $foto_perfil, $id, $id_usuario);

    if ($stmt->execute()) {
        header('Location: ../View/Gerenciar.curriculo.php');
        exit();
    } else {
        echo "Erro ao atualizar o currículo: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>
