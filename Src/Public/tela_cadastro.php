<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">

    <!--Icones Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Icones Bootstrap-->

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!--Google Fonts-->
    <title>Teste Vocacional</title>
</head>


<body>

    <header class="header">
        <div class="menu-mobile">
            <label for="chk1" onclick="menu()">
                <img class="icon" id="icon-mobile" src="/Src/assets/Imagens/cardapio.png" alt="">
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="/index.html"> Career  <span class="gradient">Fit</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home" href="/index.html" id="inicio">Inicio</a></li>
            <li><a id="#vocacional" class="teste-vocacaco" href="/Src/pages/vocacional.html"><span
                        class="teste">Teste Vocacional</span></a></li>
            <li><a id="#facul" class="faculdade" href="/Src/pages/faculdade.html">Faculdades</a></li>

            <a href="cadastro.html">
                <button id="cadastro" class="cadastro" data-toggle="modal" data-target="#ModalCriarEvento"><img
                        src="/Src/assets/Imagens/user.png" alt="image"> Cadastro</button>
                </button>
            </a>
        </ul>
    </header>

    <main class="main">
        <article class="container">
            <section class="form-image">
                <img src="imagemLogin.svg" alt="image">
            </section>

            <section class="form">
                <form action="cadastro.php" method="POST">
                    <div class="form-header">
                        <div class="title">
                            <h1>Cadastre-se</h1>
                        </div>
                        <div class="login-button">
                            <button> <a href="/Src/pages/login.html">Login</a> </button>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="input-box">
                            <label for="firstname">Nome</label>
                            <input id="name" type="text" name="name" placeholder="Digite seu name" required>
                        </div>

                        <div class="input-box">
                            <label for="date">Data de Nascimento</label>
                            <input id="date" type="date" name="data_nascimento" placeholder="Digite seu data de nascimento" >
                        </div>
                      

                        <div class="input-box">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" placeholder="Digite seu email" required>
                        </div>
                        
                        <div class="input-box">
                            <label for="local">Localização </label>
                            <input id="local" type="local" name="cep" placeholder="Digite seu CEP" required>
                        </div>
                        
                        <div class="input-box">
                            <label for="password">Senha</label>
                            <input id="password" type="password" name="senha" placeholder="Digite sua senha" required>
                         
                        </div>

                        <div class="input-box">
                            <label for="password">Confirmar Senha</label>
                            <input id="password" type="password" name="confirmSenha" placeholder="Confirme sua senha" required>
                        </div>
                    </div>

                    <!--

                    <div class="gender-inputs">
                        <div class="gender-title">
                            <h6>Entrar como: </h6>
                        </div>

                        <div class="gender-group" >
                            <div class="gender-input">
                                <input type="radio" id="estudante" name="cadEstudante">
                                <label for="estudante">Estudante</label>
                            </div>

                            <div class="gender-input">
                                <input type="radio" id="profissional" name="cadProfissional">
                                <label for="profissional">Profissional</label>
                            </div>
                        </div>
                    </div>
                    -->
                    <aside class="continue-button">
                        <button><a href="#">Cadastrar</a></button>
                    </aside>
                </form>
            </section>
        </article>
    </main>

    <script src="/Src/js/cadastro.js"></script>

</body>

</html>