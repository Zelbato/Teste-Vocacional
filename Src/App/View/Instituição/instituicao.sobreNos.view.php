<?php 

session_start();
require '../../database/config.php';

// Verifica se a instituição está logada
if (!isset($_SESSION['id_instituicao'])) {
    header("Location: ../View/Instituição/instituicao.login.view.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS-->
    <link rel="stylesheet" href="../../../Public/assets/styles/faculdade/faculdade.css">
    <!--CSS-->



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
    <title>Faculdade</title>
</head>

<body>
    <header class="header">

        <div class="menu-mobile">
            <label for="chk1" onclick="menu()">
            <i class="fa-solid fa-bars"></i>
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="instituicao.index.view.php">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home" href="instituicao.index.view.php" id="inicio">Inicio</a></li>
            <li><a id="#vocacional" href="../vocacao.view.php" id="destaque"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul" href="instituicao.sobreNos.view.php" id="eventos">Sobre Nós</a></li>

            <li><a class="mobile-entrar" href="instituicao.cadastro.php" id="eventos">Entrar</a></li>
            <li><a class="mobile-excluir" href="#" id="eventos">Excluir conta</a></li>

            <a href="#" class="menu-button">
                 <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
            </a>
            <div class="tooltip">
                <div class="position">
                <a href="instituicao.cadastro.php" >


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

              <br>

                    <div class="menu-item-content">
                        <span class="menu-item-content-title">
                            Deseja excluir sua conta <br>
                            Clique aqui para finalizar!
                        </span>
                        <span  id="myBtn" class="menu-item-content-subtitle">
                         excluir conta
                        </span>
</div>
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
                <br>
               <p><span>Atenção:</span> Essa ação não poderá ser desfeita.</p>
            </div>

            <div id="btn-pop">
                <button class="close excluir">Cancelar</button> <button class="btn-default"> <a href="">Excluir</a></button>
            </div>
        </div>
    </div>
    <main class="main">
        <section class="link">
            <div class="link-descrit">
                <ul class="categoria">
                    <li><a href="#Sobre-Nos">Sobre Nós</a></li>
                    <li><a href="#bolsas">Benefícios</a></li>
                    <li><a href="#cotas">Características</a></li>
                </ul>

                <br>

            </div>
        </section>

        <!--SOBRE AS FACULDADES-->
        <section class="faculdade" id="Sobre-Nos">
            <div class="sobre-descrit">
                <div class="title-descrit">
                    <h1 id="s-descrit">Sobre Nós?</h1>
                </div>

                <div class="txt-descrit">
                    <p>Nosso sistema de teste vocacional foi desenvolvido para ajudar alunos a descobrirem suas habilidades, interesses e talentos, auxiliando-os na escolha da área de atuação profissional mais alinhada ao seu perfil. Através de uma metodologia baseada em psicologia educacional e orientação de carreira, o teste oferece insights personalizados, conectando características individuais a possíveis carreiras.
                    </p>

                    <p>Com resultados detalhados e recomendações precisas, o sistema facilita a tomada de decisões profissionais, oferecendo clareza aos alunos em um momento crucial de suas vidas, enquanto exploram caminhos acadêmicos e oportunidades de mercado.
            
                    </p>

                </div>

                <div class="sub-title-descrit">
                    <h4>Benefícios</h4>
                </div>

                <div class="txt-descrit">
                    <p>Faculdades e instituições que cadastram seus cursos na nossa plataforma obtêm diversos benefícios. Ao conectar diretamente seus programas educacionais a alunos que já demonstraram interesse e aptidão em áreas específicas, as instituições aumentam a visibilidade de seus cursos e atraem um público mais qualificado. Isso resulta em maior taxa de engajamento e conversão de matrículas, além de promover uma melhor adequação entre o aluno e o curso, contribuindo para o sucesso acadêmico e profissional dos estudantes.</p>
                </div>

                <div class="img-faculdade"></div>

                <div class="sub-title-descrit">
                    <h3>Características</h3>
                </div>

                <div class="txt-descrit">
                    <p>Nosso sistema é fácil de usar e altamente acessível, com uma interface intuitiva que garante uma experiência fluida para os usuários. O teste é baseado em perguntas estratégicas que analisam traços de personalidade, interesses e habilidades, proporcionando resultados precisos e detalhados. Além disso, o sistema oferece:

                       <br><br>
                        <b> Relatórios personalizados:</b> Os alunos recebem um relatório completo, destacando suas áreas de força e sugestões de carreiras adequadas ao seu perfil.
                        <br> <br>
                      <b>Recomendações de cursos:</b>  Com base nos resultados, o sistema sugere cursos oferecidos pelas instituições parceiras, facilitando o caminho para a qualificação necessária.
                       <br><br>
                       <b> Conexão direta com instituições:</b> Alunos podem explorar e se conectar com as instituições que oferecem os cursos sugeridos, tudo dentro da plataforma. </p>

                    <p></p>
                </div>

               
            </div>
        </section>

    </main>


    <!--RODAPÉ-->
    <footer>
        <div class="boxs">
            <h2>Logo</h2>

            <div class="logo">
                <h1><a href="instituicao.index.view.php">New <span class="gradient">Careers</span>.</a></h1>
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
                <li><a href="instituicao.index.view.php">Home </a></li>
                <li><a href="../vocacao.view.php">Teste Vocacional </a></li>
                <li><a href="instituicao.sobreNos.view.php">Faculdades </a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="../termos.view.php">Termos de uso </a></li>
                <li><a href="../politica.view.php">Política de Privacidade </a></li>
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

    <!--JS-->
    <script src="../../../Public/assets/Js/faculdade.js"></script>
    <!--JS-->
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