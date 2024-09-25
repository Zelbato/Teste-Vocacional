<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidade</title>

    <link rel="stylesheet" href="../../Public/assets/styles/politica-privacidade/politica.css">

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Google Fonts-->

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
        <setion class="termos">
            <div class="termos-titulo">
                <h1>Política de Privacidade</h1>
            </div>

            <aside class="termos-uso">

                    <div class="termos-paragrafo">
                        <h3>1.Termos</h3>

                        <p>A sua privacidade é importante para nós. É política do Teste vocacional respeitar a sua privacidade em relação
                             a qualquer informação sua que possamos coletar no site Teste vocacional, e outros sites que possuímos
                              e operamos</p>

                        <br>
                     

                        <p>Solicitamos informações pessoais apenas quando realmente precisamos delas para lhe fornecer um serviço. 
                            Fazemo-lo por meios justos e legais, com o seu conhecimento e consentimento. Também informamos por que
                             estamos coletando e como será usado. </p>

                             <br> 

                             <p>Apenas retemos as informações coletadas pelo tempo necessário para fornecer o serviço solicitado.
                                 Quando armazenamos dados, protegemos dentro de meios comercialmente aceitáveis ​​para evitar perdas e
                                  roubos, bem como acesso, divulgação, cópia, uso ou modificação não autorizados.</p> 

                                  <br> 

                                  <p>Não compartilhamos informações de identificação pessoal publicamente ou com terceiros, 
                                    exceto quando exigido por lei.</p>
                                    
                                    <br>

                                    <p>O nosso site pode ter links para sites externos que não são operados por nós. 
                                        Esteja ciente de que não temos controle sobre o conteúdo e práticas desses sites 
                                        e não podemos aceitar responsabilidade por suas respectivas políticas de privacidade. </p>

                                        <br> 

                                        <p>Você é livre para recusar a nossa solicitação de informações pessoais, entendendo
                                             que talvez não possamos fornecer alguns dos serviços desejados.</p>

                                             <br>

                                             <p>O uso continuado de nosso site será considerado como aceitação de nossas práticas em torno de privacidade e informações pessoais. Se você tiver alguma dúvida sobre como lidamos com dados do usuário e informações pessoais, entre em contacto connosco.</p>
                        <ul>
                            <li class="uso">O serviço Google AdSense que usamos para veicular publicidade usa um cookie DoubleClick para veicular 
                                anúncios mais relevantes em toda a Web e limitar o número de vezes que um determinado anúncio é exibido para você. </li>
                                <br>
                            <li> Para mais informações sobre o Google AdSense, consulte as FAQs oficiais sobre privacidade do Google AdSense.</li>
                            <br>
                            <li>Utilizamos anúncios para compensar os custos de funcionamento deste site e fornecer financiamento para futuros desenvolvimentos.
                                 Os cookies de publicidade comportamental usados ​​por este site foram projetados para garantir que você forneça os anúncios mais
                                  relevantes sempre que possível, rastreando anonimamente seus interesses e apresentando coisas semelhantes que possam ser do
                                   seu interesse. </li>
                                   <br>
                            <li>Vários parceiros anunciam em nosso nome e os cookies de rastreamento de afiliados simplesmente nos permitem ver se
                                 nossos clientes acessaram o site através de um dos sites de nossos parceiros, para que possamos creditá-los adequadamente
                                  e, quando aplicável, permitir que nossos parceiros afiliados ofereçam qualquer promoção que pode fornecê-lo para fazer
                                   uma compra. </li>
                                   <br>
                        </ul>
                        <br>
                     <h3>Compromisso do Usuário</h3>

                     <br>

                     <p>O usuário se compromete a fazer uso adequado dos conteúdos e da informação que o Teste vocacional oferece
                         no site e com caráter enunciativo, mas não limitativo:</p>

                      <br>
          <ul>
          <li>A) Não se envolver em atividades que sejam ilegais ou contrárias à boa fé a à ordem pública;</li>
          <br>
          <li>B) Não difundir propaganda ou conteúdo de natureza racista, xenofóbica, pixbet ou azar, qualquer 
            tipo de pornografia ilegal, de apologia ao terrorismo ou contra os direitos humanos;</li> 
            <br>
            <li>C) Não causar danos aos sistemas físicos (hardwares) e lógicos (softwares) do Teste vocacional, 
                de seus fornecedores ou terceiros, para introduzir ou disseminar vírus informáticos ou quaisquer outros sistemas de hardware ou software que sejam capazes de causar danos anteriormente mencionados.</li>
           <br>
          </ul>
           <br>
          <h3>Mais informações</h3>
          <br>

          <p>Esperemos que esteja esclarecido e, como mencionado anteriormente, se houver algo que você não tem certeza se
             precisa ou não, geralmente é mais seguro deixar os cookies ativados, caso interaja com um dos recursos que 
             você usa em nosso site.</p>
             <br>

             <p>Esta política é efetiva a partir de 2 May 2024 11:00</p>
                  
                    </div>
                </div>
            </aside>
        </setion>
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
      <p>© 2024 Teste Vocacional. Todos os direitos reservados.</p>
    </div>

    <script src="../../Public/assets/Js/politica.js"></script>
    
</body>
</html>