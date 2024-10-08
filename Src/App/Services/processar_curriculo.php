<?php
require '../database/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $experiencia = $_POST['experiencia'];
    $formacao = $_POST['formacao'];
    $endereco = $_POST['endereco'];
    $habilidades = $_POST['habilidades'];

    // Verifica se um arquivo de imagem foi enviado
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['foto_perfil'];
        $foto_nome = $foto['name'];
        $foto_tmp = $foto['tmp_name'];
        
        // Define o caminho onde a imagem será salva
        $upload_dir = 'uploads/';
        $foto_caminho = $upload_dir . basename($foto_nome);
        
        // Move o arquivo para o diretório de uploads
        if (move_uploaded_file($foto_tmp, $foto_caminho)) {
            echo "Foto de perfil enviada com sucesso!";
        } else {
            echo "Erro ao enviar a foto.";
            $foto_caminho = null;
        }
    } else {
        // Se não houver uma foto enviada, define como null
        $foto_caminho = null;
    }

    // Prepara a consulta para inserir os dados no banco de dados
    $stmt = $conexao->prepare("
        INSERT INTO curriculos (nome, email, telefone, experiencia, formacao, endereco, habilidades, foto_perfil)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssssssss", $nome, $email, $telefone, $experiencia, $formacao, $endereco, $habilidades, $foto_caminho);

    // Executa a consulta
    if ($stmt->execute()) {
        header("Location: ../View/curriculo.index.view.php"); 
    } else {
        echo "Erro ao salvar o currículo: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>