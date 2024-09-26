<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="/Src/assets/styles/questoes/questoes.css"> -->
    <link rel="stylesheet" href="../../Public/assets/styles/questoes/questoes.css">
    
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
            <h1><a href="index.view.php">New <span class="gradient">Careers</span>.</a></h1>
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
    <div id="myModal" class="modal">
        <!-- Modal content -->
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
                    <button  class="btn-default">
                        <a href="">Cancelar</a></button>
                    <button type="submit" class="close excluir">Excluir</button>
                </div>
                </form>
        </div>
    </div>
    <main class="main">
        <article class="container">

            <section class="form">
                <form action="#">
                    <div class="form-header">
                        <h1>Cadastro de Questões</h1>
                    </div>

                    <!-- <div class="title">
                        <h2>Questão </h2>
                    </div> -->

                    <div class="input-group">
                        <div class="input-box">
                            <label for="questao ">Questão</label>
                            <input class="criar-questao" id="questao" type="text" name="questao"
                                placeholder="Digite a questão" required>
                        </div>
                    </div>

                    <!-- <div class="subTitle">
                        <h2>Alternativas</h2>
                    </div> -->

                    <div class="input-group">
                        <div class="input-box">
                            <label for="qustion_text">Alternativa 1</label>
                            <input class="criar-altern" id="text" type="text" name="qustion_text" placeholder="A. " required>
                            <select name="" id="">
                                <option value="">Area de Atuação</option>
                                <option value="">Administração, negócios e serviços</option>
                                <option value="">Artes e Design</option>
                                <option value="">Ciências Biológicas e da Terra</option>
                                <option value="">Análise e Desenvolvimento de Sistemas</option>
                                <option value="">Ciências Sociais e Humanas</option>
                                <option value="">Comunicação e Informação</option>
                                <option value="">Engenharia e Produção</option>
                                <option value="">Saúde e Bem-estar</option>
                            </select>
                        </div>


                        <div class="input-box">
                            <label for="qustion_text">Alternativa 2</label>
                            <input class="criar-altern" id="text" type="text" name="qustion_text" placeholder="B. " required>
                            <select name="" id="">
                                <option value="">Area de Atuação</option>
                                <option value="">Administração, negócios e serviços</option>
                                <option value="">Artes e Design</option>
                                <option value="">Ciências Biológicas e da Terra</option>
                                <option value="">Análise e Desenvolvimento de Sistemas</option>
                                <option value="">Ciências Sociais e Humanas</option>
                                <option value="">Comunicação e Informação</option>
                                <option value="">Engenharia e Produção</option>
                                <option value="">Saúde e Bem-estar</option>
                            </select>
                        </div>

                        <div class="input-box">
                            <label for="qustion_text">Alternativa 3 </label>
                            <input class="criar-altern" id="text" type="text" name="qustion_text" placeholder="C. " required>
                            <select name="" id="">
                                <option value="">Area de Atuação</option>
                                <option value="">Administração, negócios e serviços</option>
                                <option value="">Artes e Design</option>
                                <option value="">Ciências Biológicas e da Terra</option>
                                <option value="">Análise e Desenvolvimento de Sistemas</option>
                                <option value="">Ciências Sociais e Humanas</option>
                                <option value="">Comunicação e Informação</option>
                                <option value="">Engenharia e Produção</option>
                                <option value="">Saúde e Bem-estar</option>
                            </select>
                        </div>

                        <div class="input-box">
                            <label for="qustion_text">Alternativa 4</label>
                            <input class="criar-altern" id="text" type="text" name="qustion_text" placeholder="D. " required>
                            <select name="" id="">
                                <option value="">Area de Atuação</option>
                                <option value="">Administração, negócios e serviços</option>
                                <option value="">Artes e Design</option>
                                <option value="">Ciências Biológicas e da Terra</option>
                                <option value="">Análise e Desenvolvimento de Sistemas</option>
                                <option value="">Ciências Sociais e Humanas</option>
                                <option value="">Comunicação e Informação</option>
                                <option value="">Engenharia e Produção</option>
                                <option value="">Saúde e Bem-estar</option>
                            </select>
                        </div>

                    </div>



                    <aside class="continue-button">
                        <button type="submit"><a href="#">Cadastrar Questão</a></button>
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

    <script src="../../Public/assets/Js/questoes.js"></script>

</body>

</html>