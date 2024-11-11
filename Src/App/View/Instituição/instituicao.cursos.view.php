<?php
//gerenciar cursos
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
        $diretorio_imagens = __DIR__ . '../../../../../uploads/';
    
        if (!is_dir($diretorio_imagens)) {
            mkdir($diretorio_imagens, 0777, true);
        }
    
        // Gerar nome único para a imagem
        $nome_imagem = basename($foto_curso['name']);
        $caminho_imagem = '../../../../uploads/' . uniqid('', true) . '-' . $nome_imagem;

        // Mover o arquivo para o diretório de uploads
        if (!move_uploaded_file($foto_curso['tmp_name'], $diretorio_imagens . basename($caminho_imagem))) {
            echo "Erro ao enviar a imagem.";
            exit();
        }
    
        echo "Imagem enviada com sucesso!";
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
    <link rel="stylesheet" href="../../../Public/assets/styles/PagInstituicao/GerenCursos/gerenciar.cursos.css?v=<?php echo time(); ?>">

    <!--Icones Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Gerenciar Cursos</title>
</head>

<body>

    <header class="header">
        <div class="menu-mobile">
            <label for="chk1" onclick="menu()">
            <i class="fa-solid fa-bars"></i>
            </label>
        </div>
        <input type="checkbox" id="chk1">
        <div class="logo">
            <h1><a href="instituicao.index.view.php">New <span class="gradient">Careers</span>.</a></h1>
        </div>
        <ul>
            <li><a href="instituicao.index.view.php">Inicio</a></li>
            <li><a href="../vocacao.view.php">Teste Vocacional</a></li>
            <li><a href="instituicao.cadastro.php">Cadastrar-se</a></li>
            <li><a class="mobile-excluir" href="login.view.php">Entrar</a></li>
        </ul>
    </header>

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

        <div class="meuCurso">
            <?php while ($curso = $result->fetch_assoc()): ?>
                <div class="curso-content">
                    <?php if (!empty($curso['foto_curso'])): ?>
                        <img class="img-curso" src="<?php echo htmlspecialchars($curso['foto_curso']); ?>" alt="Foto do Curso">                        <?php endif; ?>
                    <div class="nome_curso">
                        <h3><strong><?php echo htmlspecialchars($curso['nome_curso']); ?></strong></h3>
                    </div>
                    <div class="descricao">
                        <p><strong>Duração:</strong> <?php echo htmlspecialchars($curso['duracao']); ?></p>
                    </div>
                    <div class="btn-pop">
                        <button class="editar-btn"><a href="instituicao.editarCurso.view.php?id=<?php echo $curso['id_curso']; ?>">Editar</a></button>
                        <button class="delet-btn"><a href="instituicao.cursos.view.php?delete=<?php echo $curso['id_curso']; ?>" onclick="return confirm('Tem certeza que deseja excluir este curso?');">Excluir</a></button>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <footer>
        <div class="footer">
            <p>Copyright © 2024 New Careers. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="../../../Public/assets/Global/Js/instituicaoGlobal.js"></script>
    <script src="../../../Public/assets/Js/instituicao.index.js"></script>

</body>
</html>
