<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/styles/login/login.css?v=<?php echo time(); ?>"><!-- ../../Public/assets/styles/login/login.css -->

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
    <!-- <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script> -->

    <!-- <header class="header">

        <div class="menu-mobile">
            <label for="chk1" onclick="menu()">
                <img class="icon" id="icon-mobile" src="../../Public/assets/Img/cardapio.png" alt="">
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="index.view.php">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home" href="index.view.php" id="inicio">Inicio</a></li>
            <li><a id="#vocacional" href="vocacao.view.php" id="destaque"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul" href="faculdade.view.php" id="eventos">Faculdades</a></li>

            <li><a class="mobile-entrar" href="cadastro.view.php" id="eventos">Entrar</a></li>
            <li><a class="mobile-excluir" href="#" id="eventos">Excluir conta</a></li>

            <a href="#" class="menu-button">
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta 
            </a>

            <div class="tooltip">
                <div class="position">
                    <a href="cadastro.view.php">


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
    </header> -->


    <!-- <div id="myModal" class="modal">
        <!-- Modal content 
        <div class="quadro">
            <div class="title-pop">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h2 id="titulo">Confirmação</h2>
            </div>

            <div class="pgf">
                <p>Deseja realmente excluir essa conta? Essa opção apagará todos seus dados até agora</p>
                <br>
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
    </div> -->

    <main class="main">
        <article class="container">
            <section class="form-image">
                <div class="title-form">
                    <h1>Faça seu login <br> e explore nosso sistema!</h1>
                </div>
                <img src="../../Public/assets/Img/Connected world-pana.png" alt="Imagem ilustrativa de tres pessoas usando o celular" loading="lazy">
            </section>

            <section class="form">
                <form action="../Services/login.php" method="POST">
                    <div class="form-header">
                        <div class="title">
                            <h1>Entrar</h1>
                        </div>

                        <div class="login-button">
                            <button> <a href="./Instituição/instituicao.login.view.php" data-message="Botão de ir para Login de instituição">Instituição</a> </button>
                        </div>

                    </div>

                    <div class="input-group">
                        <div class="input-box">
                            <label for="name">Nome</label>
                            <input id="name" type="text" name="name" placeholder="Digite seu nome" required>
                        </div>


                        <div class="input-box">
                            <label for="email">Email</label>
                            <input id="email" type="text" name="email" placeholder="Digite seu email" required>
                        </div>

                        <div class="input-box">
                            <label for="password">Senha</label>
                            <input id="password" type="password" name="senha" placeholder="Digite sua senha" required>
                        </div>

                        <div class="recuperar-senha">
                            <a href="recuperarS.view.php" data-message="opção de ir para recuperar a senha">Esqueceu sua senha?</a>
                        </div>
                    </div>



                    <aside class="continue-button">
                        <button><a href="#" data-message="Botão para entrar na sua conta">Entrar</a></button>
                    </aside>
                </form>
            </section>
        </article>
    </main>
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
    <script src="../../Public/assets/Js/login.js"></script>

</body>

</html>