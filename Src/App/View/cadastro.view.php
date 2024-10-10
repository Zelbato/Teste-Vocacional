<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/styles/cadastro/cadastro.css">

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


    <!-- <header class="header">

<div class="menu-mobile">
    <label for="chk1" onclick="menu()">
        <img class="icon" id="icon-mobile" src="../../Public/assets/Imagens/cardapio.png" alt="">
    </label>
</div>

<input type="checkbox" name="" id="chk1">

<div class="logo">
    <h1><a href="index.view.php">New <span class="gradient">Careers</span>.</a></h1>
</div>

<ul>
    <li><a id="#home inicio" href="index.view.php">Inicio</a></li>
    <li><a id="#vocacional destaque" href="vocacao.view.php"><span
                class="teste">Teste Vocacional</span></a>
    </li>
    <li><a id="#facul eventos" href="faculdade.view.php">Faculdades</a></li>
    <li><a id="#cadastro cadastrar" href="cadastro.view.php">Cadastrar-se</a></li>

    <li><a class="mobile-excluir" href="#" id="eventos">Excluir conta</a></li>
    <li><a class="mobile-excluir" href="curriculo.view.php" id="eventos">Criar curriculo</a></li>
    <li><a class="mobile-excluir" href="caminho.resultado.view.php" id="eventos">Ver carreiras</a></li>

    <a href="#" class="menu-button">
        <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta 
    </a>

    <div class="tooltip">
        <div class="position">

            <div class="menu-item-content">

                <a href="curriculo.index.view.php">
                    <div class="menu-item-content">
                        <span class="menu-item-content-title">
                            Crie seu Curriculo<br>
                            Clique aqui!
                        </span>

                        <span class="menu-item-content-subtitle">
                            Criar Curriculo <br>
                        </span>
                    </div>
                </a>

                <br>

                <a href="caminho.resultado.view.php">
                    <div class="menu-item-content">
                        <span class="menu-item-content-title">
                            Veja as carreiras obtidas<br>

                        </span>

                        <span class="menu-item-content-subtitle">
                            Ver Carreiras <br>
                        </span>
                    </div>
                </a>


            </div>
        </div>

</ul>
</header> -->

    <main class="main">
        <article class="container">
            
            <section class="form-image">
            <div class="title-form">
                <h1>Faça seu cadastro <br> e descubra sua área profissional</h1>
            </div>
                <img src="../../Public/assets/Img/Connected world-pana.png" alt="image">
            </section>

            <section class="form">
                <form action="../Services/cadastro.php" method="POST">
                    <div class="form-header">
                        <div class="title">
                            <h1>Cadastre-se</h1>
                        </div>
                        <div class="login-button">
                            <button> <a href="Instituição/instituicao.cadastro.php">Instituição</a> </button>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="input-box">
                            <label for="firstname">Nome</label>
                            <input id="name" type="text" name="name" placeholder="Digite seu name" required>
                        </div>

                        <div class="input-box">
                            <label for="date">Data de Nascimento</label>
                            <input id="date" type="date" name="data_nascimento" placeholder="">
                        </div>


                        <div class="input-box">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" placeholder="Digite seu email" required>
                        </div>

                        <div class="input-box">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" name="cep" maxlength="9" placeholder="Digite o cep" required>
                        </div>

                        <div class="input-box">
                            <label for="password">Senha</label>
                            <input id="password" type="password" name="senha" placeholder="Digite sua senha" required>

                        </div>

                    </div>

                    <div class="gender-inputs">
                        <div class="gender-title">
                            <h6>Entrar como: </h6>
                        </div>

                        <div class="gender-group">
                            <div class="gender-input">
                                <input type="radio" id="estudante" name="gender">
                                <label for="estudante">Usuário</label>
                            </div>

                            <div class="gender-input">
                                <input type="radio" id="profissional" name="gender">
                                <label for="profissional">Administrador</label>
                            </div>
                        </div>
                    </div>


                    <aside class="continue-button">
                        <button>Cadastrar</button>
                    </aside>
                </form>
            </section>
        </article>
    </main>

    <script src="../../Public/assets/Js/cadastro.js"></script>

</body>

</html>