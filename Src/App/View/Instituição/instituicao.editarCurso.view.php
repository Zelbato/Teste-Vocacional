<?php
session_start();
require '../../database/config.php';

// Verifica se a instituição está logada
if (!isset($_SESSION['id_instituicao'])) {
    header("Location: login_instituicao.php");
    exit();
}

$id_instituicao = $_SESSION['id_instituicao'];

// Verifica se o ID do curso foi passado
if (!isset($_GET['id'])) {
    die('ID do curso não fornecido.');
}

$id_curso = intval($_GET['id']);

// Carrega os dados do curso
$stmt = $conexao->prepare("SELECT * FROM cursos WHERE id_curso = ? AND id_instituicao = ?");
$stmt->bind_param("ii", $id_curso, $id_instituicao);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die('Curso não encontrado.');
}

$curso = $result->fetch_assoc();

// Atualiza os dados do curso
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_curso = $_POST['nome_curso'];
    $duracao = $_POST['duracao'];
    $descricao = $_POST['descricao'];
    $carreira_id = $_POST['carreira_id'];

    // Processar upload da imagem (se fornecida)
    $foto_curso = $_FILES['foto_curso'];
    $caminho_imagem = $curso['foto_curso'];

    if ($foto_curso['error'] === UPLOAD_ERR_OK) {
        // Verifica se o diretório para salvar as imagens existe, se não, cria
        $diretorio_imagens = 'uploads/';
        if (!is_dir($diretorio_imagens)) {
            mkdir($diretorio_imagens, 0777, true);
        }

        $nome_imagem = basename($foto_curso['name']);
        $caminho_imagem = $diretorio_imagens . uniqid('', true) . '-' . $nome_imagem;

        // Move a imagem para o diretório
        if (!move_uploaded_file($foto_curso['tmp_name'], $caminho_imagem)) {
            echo "Erro ao enviar a imagem.";
            exit();
        }
    }

    // Atualizar curso no banco de dados
    $stmt = $conexao->prepare("UPDATE cursos SET nome_curso = ?, duracao = ?, descricao = ?, carreira_id = ?, foto_curso = ? WHERE id_curso = ? AND id_instituicao = ?");
    $stmt->bind_param("sssissi", $nome_curso, $duracao, $descricao, $carreira_id, $caminho_imagem, $id_curso, $id_instituicao);
    $stmt->execute();

    // Redirecionar para gerenciar_cursos.php após a atualização
    header("Location: instituicao.cursos.view.php");
    exit();
}

// Carregar carreiras para a seleção
$carreira_result = $conexao->query("SELECT id, nome FROM carreira");
$carreiras = $carreira_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Public/assets/styles/ADM/GerenCursos/gerenciar.cursos.css?v=<?php echo time(); ?>">

    <!--Icones Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Icones Bootstrap-->

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Editar Curso</title>
</head>

<body>
    <main class="main">
        <h1>Editar Curso</h1>

        <form method="post" enctype="multipart/form-data">
            <label for="nome_curso">Nome do Curso:</label>
            <input type="text" id="nome_curso" name="nome_curso" value="<?php echo htmlspecialchars($curso['nome_curso']); ?>" required><br>

            <label for="duracao">Duração:</label>
            <input type="text" id="duracao" name="duracao" value="<?php echo htmlspecialchars($curso['duracao']); ?>" required><br>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($curso['descricao']); ?></textarea><br>

            <label for="carreira_id">Carreira:</label>
            <select id="carreira_id" name="carreira_id" required>
                <?php foreach ($carreiras as $carreira): ?>
                    <option value="<?php echo $carreira['id']; ?>" <?php if ($carreira['id'] == $curso['carreira_id']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($carreira['nome']); ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <label for="foto_curso">Foto do Curso:</label>
            <input type="file" id="foto_curso" name="foto_curso" accept="image/*"><br>

            <button type="submit">Salvar Alterações</button>
        </form>
    </main>
</body>

</html>