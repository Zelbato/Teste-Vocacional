<?php
session_start();
require '../database/config.php';

$user_id = $_SESSION['id_usuario'];

if (!isset($_GET['carreira_id'])) {
    die('Carreira não foi especificada.');
}

$carreira = intval($_GET['carreira_id']);

// Carrega instituições próximas com base no CEP do usuário e na carreira sugerida
$query = "
    SELECT i.nome_fantasia, i.url, c.nome_curso, c.duracao, c.descricao, c.foto_curso 
    FROM instituicao_cep_proximo icp
    JOIN instituicao i ON icp.id_instituicao = i.id_instituicao
    JOIN cursos c ON i.id_instituicao = c.id_instituicao
    WHERE icp.id_usuario = ? 
      AND icp.proximidade = TRUE
      AND c.carreira_id = ?";
$stmt = $conexao->prepare($query);

if ($stmt === false) {
    die('Erro ao preparar consulta: ' . $conexao->error);
}

$stmt->bind_param("ii", $user_id, $carreira);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se há resultados
if ($result->num_rows == 0) {
    $instituicoes = null;
} else {
    $instituicoes = $result->fetch_all(MYSQLI_ASSOC); // Pega todas as instituições
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/styles/NewCareers/Resultado/resultado.css?v=<?php echo time(); ?>">

    <!--Icones Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    <!--Google Fonts-->
    <title>Teste Vocacional</title>
</head>

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
            <h1><a href="index.view.php">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home inicio" href="index.view.php" data-message="Opção de voltar para a pagina inicial">Inicio</a></li>
            <li><a id="#vocacional destaque" href="vocacao.view.php" data-message="Opção de ir  para o Teste Vocacional"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul eventos" href="faculdade.view.php" data-message="Opção de ir para as faculdades">Faculdades</a></li>
            <li><a id="#cadastro cadastrar" href="cadastro.view.php" data-message="Opção de ir para o cadastro da sua conta">Cadastrar-se</a></li>
            <li><a class="mobile-excluir" href="login.view.php" data-message="Opção de entrar na sua conta">Entrar</a></li>

            <form action="../Services/deletar.php" method="POST">

                <li class="mobile-excluir"> <button data-message="Botão de excluir">Excluir</button> </li>

            </form>

            <li><a class="mobile-excluir" href="curriculo.index.view.php" id="eventos" data-message="Opção de criar o seu curriculo">Criar curriculo</a></li>
            <li><a class="mobile-excluir" href="caminho.resultado.view.php" id="eventos" data-message="Opção de ver a sua carreira">Ver carreiras</a></li>

            <a href="#" class="menu-button" data-message="mais opções para o usuário">
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

                        <a href="../editar_usuario.php">
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



                            <a href="curriculo.index.view.php" data-message="opção de ir para criar o seu curriculo">
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



                            <a href="caminho.resultado.view.php" data-message="opção para ir para a sua carreira obtida">
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

    <main class="main ">
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

                <form action="../Services/deletar.php" method="POST">
                    <div id="btn-pop">
                        <button class="btn-default">
                            <a href="">Cancelar</a></button>
                        <button type="submit" class="close excluir">Excluir</button>
                    </div>
                </form>
            </div>
        </div>

        <section class="resultado">
            <div class="title">
                <h1>Resultado do Teste Vocacional</h1>
            </div>

            <br>

            <h2>Carreira sugerida:
                <?php
                // Consulta para pegar o nome da carreira baseado no ID da carreira
                $carreira_query = $conexao->prepare("SELECT nome FROM carreira WHERE id = ?");
                $carreira_query->bind_param("i", $carreira);
                $carreira_query->execute();
                $carreira_result = $carreira_query->get_result();
                $carreira_nome = $carreira_result->fetch_assoc()['nome'];
                echo htmlspecialchars($carreira_nome);
                ?>
            </h2>
            <br>
            <h3 class="career-ofec">Instituições que oferecem cursos para esta carreira:</h3>

            <br>

            <aside class="cursos-content">
                <?php if ($instituicoes): ?>
                    <div class="cards-container">
                        <?php foreach ($instituicoes as $instituicao): ?>
                            <div class="card">
                                <div class="card-header">
                                    <!-- <strong>Instituição:</strong> -->
                                    <?php if (!empty($instituicao['url'])): ?>
                                        <h3>
                                            <a href="<?php echo htmlspecialchars($instituicao['url']); ?>" target="_blank">
                                                <?php echo htmlspecialchars($instituicao['nome_fantasia']); ?>
                                            </a>
                                        </h3>
                                    <?php else: ?>
                                        <h3><?php echo htmlspecialchars($instituicao['nome_fantasia']); ?></h3>
                                    <?php endif; ?>
                                </div>

                                <div class="card-body">

                                    <?php if (!empty($instituicao['foto_curso'])): ?>
                                        <div class="image-container">
                                            <a href="<?php echo htmlspecialchars($instituicao['url']); ?>" target="_blank">
                                            </a>
                                            <img src="<?php echo htmlspecialchars('/teste-vocacional/uploads/' . basename($instituicao['foto_curso'])); ?>" alt="Imagem do curso" class="curso-img">
                                        </div>
                                    <?php else: ?>
                                        <div class="image-container">
                                            <a href="<?php echo htmlspecialchars($instituicao['url']); ?>" target="_blank"></a>
                                            <!-- <img src="/teste-vocacional/uploads/default.png"> -->
                                        </div>
                                    <?php endif; ?>

                                    <!-- <strong>Curso:</strong> -->
                                    <p  class="nome-fantasia" style="text-align: center;"><?php echo htmlspecialchars($instituicao['nome_curso']); ?></p>

                                    <br>

                                    <div class="card-description">
                                        <div class="descricao">

                                            <p><i class="fa-regular fa-calendar"></i> <?php echo htmlspecialchars($instituicao['duracao']); ?></p>
                                        </div>

                                        <strong>Descrição:</strong>
                                        <p><?php echo htmlspecialchars($instituicao['descricao']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>Nenhuma instituição próxima foi encontrada para essa carreira.</p>
                <?php endif; ?>
            </aside>

        </section>
    </main>

    <!--RODAPÉ-->
    <footer>
        <div class="boxs">
            <h2>Logo</h2>

            <div class="logo">
                <h1><a href="index.view.php">New <span class="gradient">Careers</span>.</a></h1>
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
                <li><a href="index.view.php">Home </a></li>
                <li><a href="vocacao.view.php">Teste Vocacional </a></li>
                <li><a href="faculdade.view.php">Faculdades </a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="termos.view.php">Termos de uso </a></li>
                <li><a href="politica.view.php">Política de Privacidade </a></li>
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