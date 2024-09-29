<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/styles/PagInstituicao/Cad_Instituicao/Cad.Instituicao.css">

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
    <title>Teste Vocacional</title>
</head>

<body>

    <header class="header">

        <div class="menu-mobile">
            <label for="chk1" onclick="menu()">
                <img class="icon" id="icon-mobile" src="../../Public/assets/Img/cardapio.png" alt="">
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="../index.view.php">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home" href="../index.view.php" id="inicio">Inicio</a></li>
            <li><a id="#vocacional" href="../../vocacao.view.php" id="destaque"><span class="teste">Teste
                        Vocacional</span></a>
            </li>
            <li><a id="#facul" href="../../faculdade.view.php" id="eventos">Faculdades</a></li>

            <li><a class="mobile-entrar" href="../../cadastro.view.php" id="eventos">Entrar</a></li>
            <li><a class="mobile-excluir" href="../../faculdade.view.php" id="eventos">Excluir conta</a></li>

            <a href="#" class="menu-button">
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
            </a>
            <div class="tooltip">
                <div class="position">
                    <a href="../../cadastro.view.php">


                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Ainda não se cadastrou?<br>
                                Clique aqui para se cadastrar!
                            </span>

                            <span class="menu-item-content-subtitle">

                                Cadastrar-se <br>
                                Login
                            </span>
                        </div>
                    </a>

                </div>


        </ul>
    </header>
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

            <div id="btn-pop">
                <button class="close excluir">Cancelar</button> <button class="btn-default"> <a href="">Excluir</a></button>
            </div>
        </div>
    </div>

    <main class="main">
        <article class="container">
            <!-- <section class="form-image">
                <img src="/Src/assets/Imagens/imagemLogin.svg" alt="image">
            </section> -->

            <section class="form">
                <form action="#">
                    <div class="form-header">
                        <div class="title">
                            <h1>Cadastro de Instituição</h1>
                        </div>
                        <!-- <div class="cursos-button">
                            <button> <a href="/Src/pages/cad_Cursos.html">Cursos</a> </button>
                        </div> -->
                    </div>

                    <div class="input-group">
                        
                        <div class="input-box">
                            <label for="faculdade">Nome Fantasia</label>
                            <input id="faculdade" type="text" name="faculdade" placeholder="Nome Fantasia" required>
                        </div>

                        <div class="input-box">
                            <label for="date">URL da Instituição</label>
                            <input id="date" type="text" name="date" placeholder="Digite a URL" required>
                        </div>
                        
                        <div class="input-box">
                            <label for="raz-social">Razão Social</label>
                            <input id="raz-social" type="text" name="raz-social" placeholder="Razão Social" required>
                        </div>
                        
                        <div class="input-box">
                            <label for="cnpj">CNPJ </label>
                            <input id="cnpj" type="cnpj" name="cnpj" placeholder="Digite o CNPJ" required>
                        </div>

                        <div class="input-box">
                            <label for="local">CEP </label>
                            <input id="local" type="local" name="local" placeholder="Digite seu CEP" required>
                        </div>
                        
                        <div class="input-box">
                            <label for="password">Senha</label>
                            <input id="password" type="password" name="password" placeholder="Digite sua senha" required>
                         
                        </div>
                    </div>

                    <aside class="continue-button">
                        <button><a href="#">Cadastrar Instituição</a></button>
                    </aside>
                </form>
            </section>
        </article>
    </main>

    <!--RODAPÉ-->
    <footer>
        <div class="boxs">
            <h2>Logo</h2>

            <div class="logo">
                <h1><a href="../../index.view.php">New <span class="gradient">Careers</span>.</a></h1>
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
                <li><a href="../../index.view.php">Home </a></li>
                <li><a href="../../vocacao.view.php">Teste Vocacional </a></li>
                <li><a href="../../faculdade.view.php">Faculdades </a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="../../termos.view.php">Termos de uso </a></li>
                <li><a href="../../politica.view.php">Política de Privacidade </a></li>
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
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    
    <script src="../../Public/assets/Global/Js/instituicaoGlobal.js"></script>
    <script src="../../Public/assets/styles/cadastro/cadastro.css"></script>

</body>

</html>