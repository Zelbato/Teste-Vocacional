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
    <link rel="stylesheet" href="../../../Public/assets/styles/PagInstituicao/GerenCursos/gerenciar.cursos.css?v=<?php echo time(); ?>">

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

  <!--V-Libras-->

  <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    <header class="header">

        <div class="menu-mobile">
            <label for="chk1" onclick="menu()">
                <i class="fa-solid fa-bars"></i>
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="instituicao.index.view.php">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home" href="instituicao.index.view.php" id="inicio">Inicio</a></li>
            <li><a id="#vocacional" href="../vocacao.view.php" id="destaque"><span class="teste">Teste
                        Vocacional</span></a>
            </li>
            <li><a id="#facul" href="i." id="eventos">Sobre Nós</a></li>
            <li><a id="#cadastro" href="instituicao.cadastro.php" id="eventos">Cadastrar-se</a></li>
            <li><a class="mobile-excluir" href="login.view.php">Entrar</a></li>

            <form class="mobile-excluir" action="../Services/deletar.php" method="POST">

                <li class="mobile-excluir"> <button>Excluir</button> </li>

            </form>

            <a href="#" class="menu-button" data-message="mais opções para o usuário">
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
            </a>
            <div class="tooltip">
                <div class="position">

                    <a href="login.view.php">
                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Faça seu login<br>
                                Clique aqui!
                            </span>

                            <span class="menu-item-content-subtitle">
                                Entrar <br>
                            </span>
                        </div>
                    </a>

                    <br>

                    <a href="instituicao.login.view.php">


                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Deseja sair da Conta<br>
                                Clique aqui!
                            </span>

                            <span class="menu-item-content-subtitle">

                                Desconectar-se <br>

                            </span>
                        </div>
                    </a>

                    <br>

                    <div class="menu-item-content">
                        <span class="menu-item-content-title">
                            Deseja excluir sua conta <br>
                            Clique aqui para finalizar!
                        </span>
                        <span id="myBtn" class="menu-item-content-subtitle">
                            excluir conta
                        </span>
                    </div>
                </div>


        </ul>
    </header>

    <main class="main">
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="quadro">
            <div class="title-pop">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h2 id="titulo">Confirmação</h2>
            </div>

            <div class="pgf">
                <p>Deseja realmente excluir essa conta? Essa opção apagará todos seus dados até agora</p>
                <p><span>Atenção:</span> Essa ação não poderá ser desfeita.</p>
            </div>

            <form action="../../Services/deletar.php" method="POST">
                <div id="btn-pop">
                    <button class="btn-default">
                        <a href="">Cancelar</a></button>
                    <button type="submit" class="close excluir">Excluir</button>
                </div>
            </form>
        </div>
    </div>

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

            <label for="foto_curso">Foto da Instituição:</label>
            <input type="file" id="foto_curso" name="foto_curso" accept="image/*"><br>

            <button type="submit">Salvar Alterações</button>
        </form>
    </main>

    <!--RODAPÉ-->
    <footer>
        <div class="boxs">
            <h2>Logo</h2>

            <div class="logo">
                <h1><a href="../index.view.php">New <span class="gradient">Careers</span>.</a></h1>
            </div>


            <!-- <h2>Criadores</h2>
         <p>Desenvolvido por <a href="https://github.com/Zelbato/">Heitor Zelbato</a>
         <p>Desenvolvido por <a href="https://github.com/Zelbato/">Calebe Farias</a>
         <p>Desenvolvido por <a href="https://github.com/Zelbato/">Eduardo </a>
         <p>Desenvolvido por <a href="https://github.com/Zelbato/"> Franzin </a> -->
            </p>
        </div>
        <div class="boxs">
            <h2>Inicio</h2>
            <ul>
                <li><a href="../index.view.php">Home </a></li>
                <li><a href="../vocacao.view.php">Teste Vocacional </a></li>
                <li><a href="i.">Faculdades </a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="../termos.view.php">Termos de uso </a></li>
                <li><a href="../politica.view.php">Política de Privacidade </a></li>
            </ul>
        </div>

        <div class="boxs">
            <h2>Sobre nós</h2>
            <p>
                Somos uma empresa brasileira focada em encontrar a melhor área de atuação para nossos
                usuários e indicar as redes de ensino mais próximas dele. As maiores redes de ensino
                têm uma breve explicação de como funciona seu processo e bolsas para entrar.
            </p>
        </div>
    </footer>

    <div class="footer">
        <p>Copyright © 2024 New Careers. Todos os direitos reservados.</p>

    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script src="../../../Public/assets/Global/Js/instituicaoGlobal.js"></script>
    <script src="../../../Public/assets/Js/instituicao.index.js"></script>
</body>

</html>