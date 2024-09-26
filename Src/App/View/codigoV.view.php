<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/styles/Codigo_Verficacao/verificacao.css">

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
                <img class="icon" id="icon-mobile" src="../../Public/assets/img/cardapio.png" alt="">
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="index.view.php">New <span class="gradient">Carerrs</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home" href="index.view.php" id="inicio">Inicio</a></li>
            <li><a id="#vocacional" href="vocacao.view.php" id="destaque"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul" href="faculdade.view.php" id="eventos">Faculdades</a></li>

            <li><a class="mobile-entrar" href="cadastro.view.php" id="eventos">Entrar</a></li>
           

            <a href="#" class="menu-button">
                 <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
            </a>
        
            <div class="tooltip">
                <a href="cadastro.view.php" class="menu-item">
               
        
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
        
          

        </ul>
    </header>


    <aside class="voltar">
        <div class="voltar-content">
            <button class="voltar-btn"> <a href="recuperarS.view.php"><i class="bi bi-arrow-left"></i></a></button>
        </div>
    </aside>

    <!-- <aside class="bemvindo">
        <h1 class="bemvindo-title">Bem-vindo!</h1>
    </aside> -->

    <main class="main">

        <article class="container">

            <section class="form">
                <form action="#">
                    <div class="form-header">
                        <div class="title">
                            <h1>Verificação de Senha</h1>
                        </div>
                    </div>

                    <div class="input-group">

                        <div class="input-box">
                            <label for="email">Codígo de Verificação</label>
                            <input id="email" type="email" name="email"
                            placeholder="Código de Verificação" required>
                        </div>

                    </div>



                    <aside class="continue-button">
                        <button><a href="alterarS.view.php">Enviar</a></button>
                    </aside>
                </form>
            </section>
        </article>
    </main>

    <script src="../../Public/assets/Js/Codigo_Verificacao.js"></script>
</body>

</html>