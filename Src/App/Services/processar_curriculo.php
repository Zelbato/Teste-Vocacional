<?php
// Inicia o buffer de saída para evitar problemas com headers
ob_start();

require '../database/config.php';

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.view.php");
    exit();
}

// Obtém o ID do usuário logado
$id_usuario = $_SESSION['id_usuario'];

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

    // Prepara a consulta para inserir os dados no banco de dados, incluindo o ID do usuário
    $stmt = $conexao->prepare("
        INSERT INTO curriculos (id_usuario, nome, email, telefone, experiencia, formacao, endereco, habilidades, foto_perfil)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("issssssss", $id_usuario, $nome, $email, $telefone, $experiencia, $formacao, $endereco, $habilidades, $foto_caminho);

    // Executa a consulta
    if ($stmt->execute()) {
        header("Location: ../View/Gerenciar.curriculo.php");
    } else {
        echo "<div class='alert error'>Erro ao salvar o currículo: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conexao->close();
}

// Encerra o buffer de saída
ob_end_flush();
?>
