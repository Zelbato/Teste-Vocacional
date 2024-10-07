<?php
session_start();
require '../../database/config.php';


// Verifica se a instituição está logada
if (!isset($_SESSION['id_instituicao'])) {
    header("Location: ../View/Instituição/instituicao.login.php");
    exit();
}

$id_instituicao = $_SESSION['id_instituicao'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome_curso'])) {
    $nome_curso = $_POST['nome_curso'];
    $duracao = $_POST['duracao'];
    $descricao = $_POST['descricao'];
    $carreira_id = $_POST['carreira_id'];

    // Processar upload da imagem
    $foto_curso = $_FILES['foto_curso'];
    $caminho_imagem = '';

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

    // Inserir curso no banco de dados
    $stmt = $conexao->prepare("INSERT INTO cursos (id_instituicao, nome_curso, duracao, descricao, carreira_id, foto_curso) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssis", $id_instituicao, $nome_curso, $duracao, $descricao, $carreira_id, $caminho_imagem);
    $stmt->execute();
    $stmt->close();
}

// Excluir curso
if (isset($_GET['delete'])) {
    $id_curso = $_GET['delete'];
    $stmt = $conexao->prepare("DELETE FROM cursos WHERE id_curso = ? AND id_instituicao = ?");
    $stmt->bind_param("ii", $id_curso, $id_instituicao);
    $stmt->execute();
    $stmt->close();
}

// Carregar cursos da instituição
$stmt = $conexao->prepare("SELECT * FROM cursos WHERE id_instituicao = ?");
$stmt->bind_param("i", $id_instituicao);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../Public/assets/styles/ADM/GerenCursos/gerenciar.cursos.css">
    <title>Gerenciar Cursos</title>
</head>
<body>
    <h1>Gerenciar Cursos</h1>

    <form  method="post" enctype="multipart/form-data">
        <label for="nome_curso">Nome do Curso:</label>
        <input type="text" id="nome_curso" name="nome_curso" required><br>

        <label for="duracao">Duração:</label>
        <input type="text" id="duracao" name="duracao" required><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea><br>

        <label for="carreira_id">Carreira:</label>
        <select id="carreira_id" name="carreira_id" required>
            <?php
            $carreiras = $conexao->query("SELECT id, nome FROM carreira");
            while ($carreira = $carreiras->fetch_assoc()) {
                echo "<option value='{$carreira['id']}'>{$carreira['nome']}</option>";
            }
            ?>
        </select><br>

        <label for="foto_curso">Foto do Curso:</label>
        <input type="file" id="foto_curso" name="foto_curso" accept="image/*" ><br>

        <button type="submit">Adicionar Curso</button>
    </form>

    <h2>Meus Cursos</h2>
    <ul>
        <?php while ($curso = $result->fetch_assoc()): ?>
            <li>
                <strong><?php echo htmlspecialchars($curso['nome_curso']); ?></strong> 
                (<?php echo htmlspecialchars($curso['duracao']); ?>) - 
                <?php if (!empty($curso['foto_curso'])): ?>
                    <br><img src="<?php echo htmlspecialchars($curso['foto_curso']); ?>" alt="Foto do Curso" style="width: 100px; height: auto;"><br>
                <?php endif; ?>
                <a href="instituicao.editarCurso.view.php?id=<?php echo $curso['id_curso']; ?>">Editar</a> | 
                <a href="instituicao.cursos.view.php?delete=<?php echo $curso['id_curso']; ?>" onclick="return confirm('Tem certeza que deseja excluir este curso?');">Excluir</a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
