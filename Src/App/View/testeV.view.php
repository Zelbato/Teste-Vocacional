<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Src/assets/styles/Careerfit/careerfit.css">

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
                <img class="icon" id="icon-mobile" src="/Src/assets/Imagens/cardapio.png" alt="">
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="index.view.php">Career <span class="gradient">Fit</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home" href="/index.html" id="inicio">Inicio</a></li>
            <li><a id="#vocacional" href="/Src/pages/vocacional.html" id="destaque"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul" href="/Src/pages/faculdade.html" id="eventos">Faculdades</a></li>

            <li><a class="mobile-entrar" href="/Src/pages/faculdade.html" id="eventos">Entrar</a></li>
            <li><a class="mobile-excluir" href="/Src/pages/faculdade.html" id="eventos">Excluir conta</a></li>

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

    <!-- <div id="loader"></div> -->

    <main class="main">
        <section class="quiz-section">
            <div class="quiz">
                <h2 class="question-text">O emprego ideal é aquele no qual você:</h2>
                <div class="option-list">
                    <!-- As opções serão geradas dinamicamente pelo JavaScript -->
                </div>
                <div class="quiz-footer">
                    <span class="question-total">1 / 30 Questões</span>
                    <button class="next-btn">Próxima Pergunta</button>
                </div>
            </div>

            <div class="result-box"><!--Parte de Localização-->
                <h2>Resultado do Teste</h2>
                <div class="result-container">
                    <span class="score-text">Você acertou 0 de 30</span>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="boxs">
            <h2>Logo</h2>
            <div class="logo">
                <h1><a href="index.html">Career <span class="gradient">Fit</span>.</a></h1>
            </div>
        </div>
        <div class="boxs">
            <h2>Inicio</h2>
            <ul>
                <li><a href="/index.html">Home</a></li>
                <li><a href="/Src/Site/pages/Vocacional/vocacional.html">Teste Vocacional</a></li>
                <li><a href="/Src/Site/pages/Faculdade/faculdade.html">Faculdades</a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="/Src/Site/pages/termos/termos.html">Termos de uso</a></li>
                <li><a href="/Src/Site/pages/termos/politica_privacidade/politica.html">Política de Privacidade</a></li>
                <li><a href="#">FAQ</a></li>
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
        <p>© 2024 Career Fit. Todos os direitos reservados.</p>
    </div>

    <script src="/Src/assets/js/Careerfit/questCareerFit.js"></script>
    <script src="/Src/assets/js/Careerfit/careerfit.js"></script>
</body>
</html>