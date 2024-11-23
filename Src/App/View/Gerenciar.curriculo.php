<?php
session_start();
require '../database/config.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.view.php");
    exit();
}

// ID do usuário logado
$id_usuario = $_SESSION['id_usuario'];

// Verificar conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Executar a consulta para buscar currículos do usuário logado
$query = "SELECT * FROM curriculos WHERE id_usuario = ?";
$stmt = $conexao->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Currículos</title>
    <link rel="stylesheet" href="../../Public/assets/styles/curriculo/meuCurriculo.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Cabeçalho -->
    <header class="header">

        <div class="menu-mobile">
            <label for="chk1" onclick="menu()">
                <i class="fa-solid fa-bars"></i>
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="index.view.php" data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home inicio" href="index.view.php" data-message="Opção de voltar para a pagina inicial">Inicio</a></li>
            <li><a id="#vocacional destaque" href="vocacao.view.php" data-message="Opção de ir  para o Teste Vocacional"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul eventos" href="faculdade.view.php" data-message="Opção de ir para as faculdades">Faculdades</a></li>
            <li><a id="#cadastro cadastrar" href="cadastro.view.php" data-message="Opção de ir para o cadastro da sua conta">Cadastrar-se</a></li>
            <li><a class="mobile-excluir" href="login.view.php" data-message="Opção de entrar na sua conta">Entrar</a></li>

            <form class="mobile-excluir" action="../Services/deletar.php" method="POST">
                <li class="mobile-excluir"> <button data-message="Botão de excluir">Excluir</button> </li>
            </form>

            <li><a class="mobile-excluir" href="curriculo.index.view.php" id="eventos" data-message="Opção de criar o seu curriculo">Criar curriculo</a></li>
            <li><a class="mobile-excluir" href="caminho.resultado.view.php" id="eventos" data-message="Opção de ver a sua carreira">Ver carreiras</a></li>

            <a href="#" class="menu-button" data-message="Mais opções para o usuário">
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
            </a>

            <div class="tooltip">
                <div class="position">
                    <div class="position">

                        <a href="login.view.php" data-message="Opção de ir para o Login da sua conta">
                            <div class="menu-item-content">
                                <span class="menu-item-content-title">
                                    Faça seu login
                                    Clique aqui!
                                </span>

                                <span class="menu-item-content-subtitle">
                                    Entrar
                                </span>
                            </div>
                        </a>

                        <a href="../editar_usuario.php" data-message="Opção de ir para o editar usuario">
                            <div class="menu-item-content">
                                <span class="menu-item-content-title">
                                    Deseja editar seu usuário!
                                </span>

                                <span class="menu-item-content-subtitle">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar Usuário
                                </span>
                            </div>

                        </a>

                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Deseja excluir sua conta
                                Clique aqui!
                            </span>

                            <span id="myBtn" class="menu-item-content-subtitle">
                                excluir conta
                            </span>



                            <a href="curriculo.index.view.php" data-message="Opção de ir para criar o seu curriculo">
                                <div class="menu-item-content">
                                    <span class="menu-item-content-title">
                                        Crie seu Curriculo
                                        Clique aqui!
                                    </span>

                                    <span class="menu-item-content-subtitle">
                                        Criar Curriculo
                                    </span>
                                </div>
                            </a>



                            <a href="caminho.resultado.view.php" data-message="Opção de ir para a sua carreira obtida">
                                <div class="menu-item-content">
                                    <span class="menu-item-content-title">
                                        Veja as carreiras obtidas

                                    </span>

                                    <span class="menu-item-content-subtitle">
                                        Ver Carreiras
                                    </span>
                                </div>
                            </a>


                        </div>
                    </div>

        </ul>
    </header>

    <!-- Conteúdo Principal -->
    <main class="main">
        <div id="myModal" class="modal">
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
                            <a href="" data-message="Botão de cancelar">Cancelar</a></button>
                        <button type="submit" class="close excluir" data-message="Botão de excluir">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
        <section class="form-curriculo">
            <h2>Seus Currículos</h2>
            <div class="scroll">
                <?php if ($result->num_rows > 0): ?>
                    <ul>
    <?php while ($curriculo = $result->fetch_assoc()): ?>
        <li>
            <strong><?php echo htmlspecialchars($curriculo['nome']); ?></strong>
        </li>
        <li>
            <a href="Ecurriculo.view.php?id=<?php echo $curriculo['id']; ?>">Editar</a>
            <a href="ver.curriculo_view.php?id=<?php echo $curriculo['id']; ?>">Visualizar</a>
            <a href="../Services/baixar.curriculo.php?id=<?php echo $curriculo['id']; ?>">Baixar</a>
            <form action="../Services/deletar_curriculo.php" method="POST" style="display:inline;">
                <input type="hidden" name="id_curriculo" value="<?php echo $curriculo['id']; ?>">
                <button type="submit" onclick="return confirm('Tem certeza que deseja deletar este currículo?');">Deletar</button>
            </form>
        </li>
    <?php endwhile; ?>
</ul>
                <?php else: ?>
                    <p>Você ainda não possui currículos cadastrados.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Rodapé -->
    <footer>
        <div class="boxs">
            <h2>Logo</h2>
            <div class="logo">
                <h1><a href="../index.view.php" data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
            </div>
        </div>
        <div class="boxs">
            <h2>Inicio</h2>
            <ul>
                <li><a href="../index.view.php" data-message="Opção de voltar para a tela inicial">Home </a></li>
                <li><a href="../vocacao.view.php" data-message="Opção de ir para o Teste Vocacional">Teste Vocacional </a></li>
                <li><a href="../faculdade.view.php" data-message="Opção de ir para as Faculdades">Faculdades </a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="../termos.view.php" data-message="Opção de ir para o Termos de uso">Termos de uso </a></li>
                <li><a href="../politica.view.php" data-message="Opção de ir para a Politica de Privacidade">Política de Privacidade </a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Sobre nós</h2>
            <p>Somos uma empresa brasileira focada em encontrar a melhor área de atuação para nossos usuários e indicar as redes de ensino mais próximas dele.</p>
        </div>
    </footer>

    <script src="../../Public/assets/js/index.js"></script>

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
</body>

</html>

<?php
// Fechar a conexão
$stmt->close();
$conexao->close();
?>