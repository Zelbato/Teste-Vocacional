<?php
session_start();
require '../database/config.php';

$user_id = $_SESSION['id_usuario'];
$carreira_id = $_GET['carreira_id']; // Presume-se que o ID da carreira seja passado por parâmetro na URL

// Consulta para buscar o caminho percorrido (perguntas e respostas) do usuário para uma carreira específica
$query = "
    SELECT q.question_text AS question_text, o.option_text AS option_text
    FROM user_responses ur
    JOIN options o ON ur.option_id = o.id
    JOIN questions q ON ur.question_id = q.id
    WHERE ur.user_id = ? AND ur.carreira_id = ?";

$stmt = $conexao->prepare($query);
$stmt->bind_param("ii", $user_id, $carreira_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/styles/NewCareers/Resultado/caminho.resultado.css?v=<?php echo time(); ?>">

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
    <title>Caminho para a Carreira</title>
</head>

<body>
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
            <h1><a href="index.view.php" data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home inicio" href="index.view.php" data-message="Opção para voltar para a pagina inicial" >Inicio</a></li>
            <li><a id="#vocacional destaque" href="vocacao.view.php"  data-message="Opção para ir  para o Teste Vocacional"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul eventos" href="faculdade.view.php" data-message="Opção para ir para as faculdades">Faculdades</a></li>
            <li><a id="#cadastro cadastrar" href="cadastro.view.php" data-message="Opção para ir para o cadastro da sua conta">Cadastrar-se</a></li>
            <li><a class="mobile-excluir" href="login.view.php" data-message="Opção para entrar na sua conta">Entrar</a></li>

            <form action="../Services/deletar.php" method="POST">

                <li class="mobile-excluir"> <button data-message="opção de excluir">Excluir</button> </li>

            </form>

            <li><a class="mobile-excluir" href="curriculo.index.view.php" id="eventos" data-message="Opção para criar o seu curriculo">Criar curriculo</a></li>
            <li><a class="mobile-excluir" href="caminho.resultado.view.php" id="eventos" data-message="Opção para ver a sua carreira">Ver carreiras</a></li>

            <a href="#" class="menu-button" data-message="mais opções para o usuário">
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
            </a>

            <div class="tooltip">
                <div class="position">
                    <div class="position">

                        <a href="login.view.php"  data-message="Opção de ir para o Login da sua conta">
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
                        <button type="submit" class="close excluir" data-message="opção de excluir">Excluir</button>
                    </div>
                </form>
            </div>
        </div>

            <section class="ver-caminho">
                <h1>Caminho para a Carreira</h1>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div>
                        <p><strong>Pergunta:</strong>
                            <?php echo isset($row['question_text']) ? htmlspecialchars($row['question_text']) : 'Texto da pergunta não encontrado'; ?>
                        </p>
                        <p><strong>Resposta:</strong>
                            <?php echo isset($row['option_text']) ? htmlspecialchars($row['option_text']) : 'Texto da resposta não encontrado'; ?>
                        </p>
                    </div>
                    <hr>
                <?php endwhile; ?>

                <?php if ($result->num_rows === 0): ?>
                    <p>Nenhuma resposta encontrada para esta carreira.</p>
                <?php endif; ?>
            </section>
        </main>

        <!--RODAPÉ-->
        <footer>
            <div class="boxs">
                <h2>Logo</h2>

                <div class="logo">
                    <h1><a href="index.view.php" data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
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
                    <li><a href="index.view.php" data-message="Opção para voltar para a tela inicial">Home </a></li>
                    <li><a href="vocacao.view.php" data-message="Opção para ir para o Teste Vocacional">Teste Vocacional </a></li>
                    <li><a href="faculdade.view.php" data-message="Opção para ir para as Faculdades">Faculdades </a></li>
                </ul>
            </div>
            <div class="boxs">
                <h2>Suporte</h2>
                <ul>
                    <li><a href="termos.view.php" data-message="Opção para ir para o Termos de uso">Termos de uso </a></li>
                    <li><a href="politica.view.php" data-message="Opção para ir para a Politica de Privacidade">Política de Privacidade </a></li>
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