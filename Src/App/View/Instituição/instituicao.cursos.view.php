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
    <title>Gerenciar Cursos</title>
</head>

<body>
    <main class="main">
        <h1>Gerenciar Cursos</h1>

        <form method="post" enctype="multipart/form-data">
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
            <input type="file" id="foto_curso" name="foto_curso" accept="image/*"><br>

            <button type="submit">Adicionar Curso</button>
        </form>

        <br><br><br><br>

        <h1>Meus Cursos</h1>
        <ul>
            <?php while ($curso = $result->fetch_assoc()): ?>
                <li>
                    <?php if (!empty($curso['foto_curso'])): ?>
                        <br><img src="<?php echo htmlspecialchars($curso['foto_curso']); ?>" alt="Foto do Curso" aspect-radius="16/9"><br>
                    <?php endif; ?>
                    <div class="nome_curso">
                        <h3><strong><?php echo htmlspecialchars($curso['nome_curso']); ?></strong></h3>
                    </div>

                    <div class="descricao">
                        
                        <p> <img class="calendario" src="../../../Public/assets/Img/calendario (1).png" alt="calendario"> <strong> Duração: </strong> <?php echo htmlspecialchars($curso['duracao']); ?> </p>
                    </div>

                    <div class="btn-pop">
                        <button class="editar-btn"> <a href="instituicao.editarCurso.view.php?id=<?php echo $curso['id_curso']; ?>">Editar</a> </button>
                        <button class="delet-btn"> <a href="instituicao.cursos.view.php?delete=<?php echo $curso['id_curso']; ?>" onclick="return confirm('Tem certeza que deseja excluir este curso?');">Excluir</a></button>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </main>
</body>

</html>