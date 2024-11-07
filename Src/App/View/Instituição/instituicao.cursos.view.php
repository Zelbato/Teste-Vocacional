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
        // Caminho absoluto para o diretório de uploads na raiz do projeto
        $diretorio_imagens = __DIR__ . '/uploads/';  // __DIR__ pega o diretório atual do script PHP
    
        // Verifica se o diretório para salvar as imagens existe, se não, cria
        if (!is_dir($diretorio_imagens)) {
            mkdir($diretorio_imagens, 0777, true);  // Cria o diretório, se não existir, com permissões 0777
        }
    
        $nome_imagem = basename($foto_curso['name']);  // Pega o nome da imagem sem caminho
        $caminho_imagem = $diretorio_imagens . uniqid('', true) . '-' . $nome_imagem;  // Gera um caminho único
    
        // Move a imagem para o diretório
        if (!move_uploaded_file($foto_curso['tmp_name'], $caminho_imagem)) {
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

            <label for="foto_curso">Foto da Instituição:</label>
            <input type="file" id="foto_curso" name="foto_curso" accept="image/*"><br>

            <button type="submit">Adicionar Curso</button>
        </form>

        <br><br><br><br>

        <h1>Meus Cursos</h1>

        <div class="meuCurso">
            <?php while ($curso = $result->fetch_assoc()): ?>

                <div class="curso-content">
                    <?php if (!empty($curso['foto_curso'])): ?>
                        <br><img class="img-curso" src="<?php echo htmlspecialchars($curso['foto_curso']); ?>" alt="Foto do Curso" aspect-radius="16/9"><br>
                    <?php endif; ?>

                    <div class="nome_curso">
                        <h3><strong><?php echo htmlspecialchars($curso['nome_curso']); ?></strong></h3>
                    </div>

                    <div class="descricao">
                        <p><img class="calendario" src="../../../Public/assets/Img/calendario (1).png" alt="calendario"> <strong> Duração: </strong> <?php echo htmlspecialchars($curso['duracao']); ?></p>
                    </div>

                    <div class="btn-pop">
                        <button class="editar-btn"><a href="instituicao.editarCurso.view.php?id=<?php echo $curso['id_curso']; ?>">Editar</a></button>
                        <button class="delet-btn"><a href="instituicao.cursos.view.php?delete=<?php echo $curso['id_curso']; ?>" onclick="return confirm('Tem certeza que deseja excluir este curso?');">Excluir</a></button>
                    </div>
                </div>

            <?php endwhile; ?>
        </div>
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