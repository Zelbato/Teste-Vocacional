<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/styles/login/login.css">

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
    <h1><a href="index.view.php">Career <span class="gradient">Careers</span>.</a></h1>
</div>

<ul>
    <li><a id="#home" href="/index.html" id="inicio">Inicio</a></li>
    <li><a id="#vocacional" href="/Src/pages/vocacional.html" id="destaque"><span
                class="teste">Teste Vocacional</span></a>
    </li>
    <li><a id="#facul" href="/Src/pages/faculdade.html" id="eventos">Faculdades</a></li>

    <li><a class="mobile-entrar" href="cadastro.view.php" id="eventos">Entrar</a></li>
    <li><a class="mobile-excluir" href="#" id="eventos">Excluir conta</a></li>

    <a href="#" class="menu-button">
         <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
    </a>

    <div class="tooltip">
        <a href="/Src/pages/cadastro.html" class="menu-item">
       

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

        <a href="/Src/pages/questoe.html" class="menu-item">

            <div class="menu-item-content">
                <span class="menu-item-content-title">
                   Deseja excluir sua conta <br>
                   Clique aqui para finalizar!
                </span>
                <span class="menu-item-content-subtitle">
                    Excluir conta
                 </span>
            </div>
        </a> 

</ul>
</header>

    <main class="main">
        <article class="container">
            <section class="form-image">
                <img src="../imagemLogin.svg" alt="image">
            </section>

            <section class="form">
                <form action="../Services/login.php" method="POST">
                    <div class="form-header">
                        <div class="title">
                            <h1>Entrar</h1>
                        </div>
        
                    </div>

                    <div class="input-group">
                        <div class="input-box">
                            <label for="name">Nome</label>
                            <input id="name" type="text" name="name" placeholder="Digite seu nome" required>
                        </div>

                        <div class="input-box">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" placeholder="Digite seu email" required>
                        </div>

                        <div class="input-box">
                            <label for="password">Senha</label>
                            <input id="password" type="password" name="senha" placeholder="Digite sua senha" required>
                        </div>

                        <div class="recuperar-senha">
                            <a href="/Src/pages/recuperar.html">Esqueceu sua senha?</a>
                        </div>
                    </div>

                    
                       <button class="inputSubmit" type="submit" name="submit" value="enviar"><a href="adm.view.php">Logar</a></button>
                     
                    
                </form>
            </section>
        </article>
    </main>

    <script src="/Src/js/login.js"></script>

</body>

</html>