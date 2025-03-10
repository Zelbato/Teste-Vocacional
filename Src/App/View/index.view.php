<?php

session_start();
require '../database/config.php';

// Verifica se o usuário está logado e possui uma sessão válida
if ($_SESSION['nivel'] === 'user') {
    $user_id = $_SESSION['id_usuario'];
} else if ($_SESSION['nivel'] === 'admin') {
    header("Location: ../View/ADM/adm.view.php");
    exit(); // Para o script após o redirecionamento
} else if (isset($_SESSION['id_instituicao']) && !empty($_SESSION['id_instituicao'])) {
    header('Location: ../View/Instituição/instituicao.index.view.php');
    exit(); // Para o script após o redirecionamento
}


// Se o usuário for um usuário comum, ele não será redirecionado e poderá continuar na página principal
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../Public/assets/styles/index/style.css?v=<?php echo time(); ?>">

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
    <!--Google Fonts-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Bootstrap-->
    <title>Teste Vocacional</title>

</head>

<body>
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
                <div class="vw-plugin-top-wrapper"></div>
            </div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    <header class="header" role="banner">

        <div class="menu-mobile">
            <label for="chk1" onclick="menu()">
                <i class="fa-solid fa-bars"></i>
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="index.view.php"  data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home inicio" href="index.view.php" data-message="Opção de voltar para a pagina inicial">Inicio</a></li>
            <li><a id="#vocacional destaque" href="vocacao.view.php" data-message="Opção de ir  para o Teste Vocacional"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul eventos" href="faculdade.view.php" data-message="Opção de ir para as faculdades">Faculdades</a></li>
            <!-- <li><a id="#cadastro cadastrar" href="cadastro.view.php" data-message="Opção de ir para o cadastro da sua conta">Cadastrar-se</a></li> -->
            <li><a class="mobile-excluir" href="../Services/desconectar.php" data-message="Opção de desconectar sua conta">Desconectar-se</a></li>

            <form action="../Services/deletar.php" method="POST" >

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

                        <a href="../Services/desconectar.php" data-message="Opção de desconectar sua conta">
                            <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Deseja sair da Conta<br>
                            </span>


                                <span class="menu-item-content-subtitle">
                                    Desconectar-se
                                </span>
                            </div>
                        </a>
                        
                        <a href="editar_usuario.php?usuario_id=<?php echo $_SESSION['id_usuario']; ?>">
                            <div class="menu-item-content">
                                <span class="menu-item-content-title">
                                    Deseja editar seu usuário!
                                </span>

                                <span class="menu-item-content-subtitle">
                                    <!-- <i class="fa-solid fa-pen-to-square"></i>--> Editar Usuário 
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

    <!--Sobre Nós-->

    <!--PAG-1-->
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
                            <a href="" data-message="Botão de cancelar">Cancelar</a></button>
                        <button type="submit"  data-message="Botão de excluir" class="close excluir">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
        <section class="inicio ">
            <div class="inicio-content">
                <div class="description ">
                    <h2></h2><!--Importante-->

                    <span class="texto"></span>
                    <span class="texto-2"></span>

                    <br>

                    <button class="button"> <a href="vocacao.view.php" class="teste-btn" data-message="Botão de ir para o Teste Vocacional">Teste
                            Vocacional</a> </button>

                </div>

            </div>
        </section>

        <!--SOBRE TESTE-->
        <section class="sobre js-global">

            <div class="sobre-content">

                <div class="image-content">
                    <img src="../../Public/assets/Img/estudante-formando.png" alt="Imagem ilustrativa de estudantes se formando"  loading="lazy">
                </div>

                <div class="paragrafo">
                    <h3>O que é o Teste Vocacional?</h3>
                    <p>
                        O teste Vocacional é uma ferramenta utilizada por vários especialistas na área
                        da saúde com seus pacientes. O teste é realizado com a intenção de auxiliar os
                        usuários, pacientes e afins, assim ajudando a descobrir uma carreira
                        compatível com seus gostos e características.
                    </p>


                </div>
            </div>

        </section>

        <!--CARDS-->
        <section class="cards ">

            <div class="card-titulo js-global">
                <h1>Benefícios</h1>
            </div>

            <aside class="card contact js-global">

                <h3>Inteligência lógico-matemática</h3>
                <span>Resolução de problemas matemáticos, habilidades analíticas e lógicas.
                </span>

            </aside>

            <aside class="card shop js-global">

                <h3>Inteligência linguística</h3>
                <span>Usar a linguagem para a compreensão e linguagem de modo eficaz.</span>

            </aside>

            <aside class="card about js-global">

                <h3>Inteligência espacial</h3>
                <span>Está ligada a compreender, reconhecer e criar Img de maneira distinta.</span>
            </aside>

            <aside class="card about js-global">

                <h3>Inteligência musical</h3>
                <span>Indivíduos que possuem facilidade em aprender e tocar instrumentos musicais.</span>
            </aside>

            <aside class="card about js-global">

                <h3>Inteligência físico-cinestésica</h3>
                <span>Alta habilidade de coordenação motora entre corpo e mente está ligada geralmente a atletas.</span>
            </aside>

            <aside class="card about js-global">

                <h3> Inteligência intrapessoal</h3>
                <span>Compreensão de suas próprias emoções, motivos e metas.</span>
            </aside>

            <aside class="card about js-global">

                <h3>Inteligência naturalista</h3>
                <span>Compreensão geológica, cuidado com os animais e cultivos de plantas.</span>
            </aside>

            <aside class="card about js-global">

                <h3>Inteligência existencial</h3>
                <span>Compreender questões profundas como a existência e sentido da vida.</span>
            </aside>

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
           <p>Desenvolvido por <a href="https://github.com/Zelbato/">Eduardo Rodrigues </a>
           <p>Desenvolvido por <a href="https://github.com/Zelbato/"> João Gianini </a> -->
            </p>
        </div>
        <div class="boxs">
            <h2>Inicio</h2>
            <ul>
                <li><a href="index.view.php" data-message="Opção de voltar para a tela inicial">Home </a></li>
                <li><a href="vocacao.view.php" data-message="Opção de ir para o Teste Vocacional">Teste Vocacional </a></li>
                <li><a href="faculdade.view.php" data-message="Opção de ir para as Faculdades">Faculdades </a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="termos.view.php" data-message="Opção de ir para o Termos de uso">Termos de uso </a></li>
                <li><a href="politica.view.php" data-message="Opção de ir para a Politica de Privacidade">Política de Privacidade </a></li>
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