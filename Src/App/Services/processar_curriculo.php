<?php
require '../database/config.php';
require '../View/curriculo.view.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $experiencia = $_POST['experiencia'];
    $formacao = $_POST['formacao'];
    $endereco = $_POST['endereco'];
    $habilidades = $_POST['habilidades'];

    // Caminho absoluto para o diretório 'uploads' na raiz do projeto
    $upload_dir = __DIR__ . '../../../../uploads/';

    // Verifica se o diretório para salvar as imagens existe, se não, cria
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Verifica se um arquivo de imagem foi enviado
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['foto_perfil'];
        $nome_imagem = uniqid('', true) . '-' . basename($foto['name']);
        $foto_caminho = $upload_dir . $nome_imagem;

        // Move a imagem para o diretório de uploads
        if (move_uploaded_file($foto['tmp_name'], $foto_caminho)) {
            echo "Foto de perfil enviada com sucesso!";
            // Armazena o caminho relativo para salvar no banco de dados
            $foto_caminho = '../../../uploads/' . $nome_imagem;
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
        echo "Currículo salvo com sucesso!";
    } else {
        echo "Erro ao salvar o currículo: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>
