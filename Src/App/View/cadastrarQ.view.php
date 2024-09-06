

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="/Src/assets/styles/questoes/questoes.css"> -->
    <link rel="stylesheet" href="/Src/assets/styles/questoes/questoes.css">
    
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
            <h1><a href="index.view.php">New <span class="gradient">Careers</span>.</a></h1>
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

    <main class="main">
        <article class="container">
            <section class="form">
                <h1>Cadastro de Questões</h1>
                <form id="questionForm" action="../Services/criarq.php" method="POST">
                    <div class="input-group">
                        <div class="input-box">
                            <label for="question_text">Questão</label>
                            <input class="criar-questao" id="question_text" type="text" name="question_text" placeholder="Digite a questão" required>
                        </div>
                    </div>

                    <div id="options-container">
                        <!-- Div para opções -->
                    </div>

                    <button type="button" onclick="addOption()">Adicionar Opção</button><br>
                    <button type="submit">Cadastrar Questão</button>
                </form>
            </section>
        </article>
    </main>

    <script>
        let optionCount = 1;

        function addOption() {
            const optionsContainer = document.getElementById('options-container');
            const newOptionDiv = document.createElement('div');
            newOptionDiv.classList.add('input-group');
            newOptionDiv.innerHTML = `
                <div class="input-box">
                    <label for="option_text_${optionCount}">Alternativa ${optionCount}</label>
                    <input class="criar-altern" id="option_text_${optionCount}" type="text" name="options[${optionCount}][text]" placeholder="${String.fromCharCode(64 + optionCount)}. " required>
                    <select name="options[${optionCount}][career]" required>
                        <option value="lawyer">Área de Atuação</option>
                        <option value="math_teacher">Administração, Negócios e Serviços</option>
                        <option value="programmer">Artes e Design</option>
                        <option value="math_teacher">Ciências Biológicas e da Terra</option>
                        <option value="programmer">Análise e Desenvolvimento de Sistemas</option>
                        <option value="lawyer">Ciências Sociais e Humanas</option>
                        <option value="lawyer">Comunicação e Informação</option>
                        <option value="math_teacher">Engenharia e Produção</option>
                        <option value="lawyer">Saúde e Bem-estar</option>
                    </select>
                </div>
            `;
            optionsContainer.appendChild(newOptionDiv);
            optionCount++;
        }
    </script>
    
    <!--RODAPÉ-->
    <footer>
        <div class="boxs">
            <h2>Logo</h2>

            <div class="logo">
                <h1><a href="/index.html">New <span class="gradient">Careers</span>.</a></h1>
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
                <li><a href="/index.html">Home </a></li>
                <li><a href="/Src/pages/vocacional.html">Teste Vocacional </a></li>
                <li><a href="faculdade.html">Faculdades </a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="/Src/pages/termos.html">Termos de uso </a></li>
                <li><a href="/Src/pages/politica.html">Política de Privacidade </a>
                </li>
                <li><a href="#">FAQ </a></li>
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

    <script src="/Src/assets/js/questoes.js"></script>

</body>

</html>