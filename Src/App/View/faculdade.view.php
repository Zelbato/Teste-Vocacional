<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS-->
    <link rel="stylesheet" href="../../Public/assets/styles/faculdade/faculdade.css">
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
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
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

                    <br>

                    <div class="menu-item-content">
                        <span class="menu-item-content-title">
                            Deseja excluir sua conta <br>
                            Clique aqui para finalizar!
                        </span>
                        <span id="myBtn" class="menu-item-content-subtitle">
                            excluir conta
                        </span>
                    </div>

                    <br>
                        
                        <a href="curriculo.view.php">
                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Deseja criar seu curriculo<br>
                                Clique aqui!
                            </span>

                            <span class="menu-item-content-subtitle">
                                Criar Curriculo <br>
                            </span>
                        </div>
                        </a>

                        <br>

                        <a href="Ecurriculo.view.php">
                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Deseja editar seu curriculo<br>
                                Clique aqui!
                            </span>

                            <span class="menu-item-content-subtitle">
                                Editar Curriculo <br>
                            </span>
                        </div>
                        </a>
                        
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

            <form action="../Services/deletar.php" method="POST">
                <div id="btn-pop">
                    <button class="btn-default">
                        <a href="">Cancelar</a></button>
                    <button type="submit" class="close excluir">Excluir</button>
                </div>
            </form>
        </div>
    </div>
    <main class="main">
        <section class="link">
            <div class="link-descrit">
                <ul class="categoria">
                    <li><a href="#faculdade">Faculdade</a></li>
                    <li><a href="#bolsas">Bolsas</a></li>
                    <li><a href="#cotas">Cotas</a></li>
                </ul>

                <br>

                <h2>Venha descobrir um pouco mais sobre o que você pode conquistar com uma <span><a
                            href="https://www.faesa.br/blog/tag/faculdade">Faculdade</a></span>
                </h2>
            </div>
        </section>

        <!--SOBRE AS FACULDADES-->
        <section class="faculdade" id="faculdade">
            <div class="sobre-descrit">
                <div class="title-descrit">
                    <h1 id="s-descrit">Qual a diferença entre faculdade e universidade?</h1>
                </div>

                <div class="txt-descrit">
                    <p>Após completar o ensino médio, surge uma dúvida na maioria dos estudantes: qual a diferença entre
                        universidade e faculdade, também em qual é a melhor opção para entrar, por isso a seguir
                        mostraremos a diferença entre ambas e nos aprofundaremos na faculdade.
                    </p>

                    <p>A universidade ela tem vários cursos sendo eles de várias áreas diferentes, não tendo um foco
                        único, sendo assim uma instituição de ensino superior mais abrangente, além disso, ela pode
                        oferecer cursos de extensão, pesquisas e atividades culturais, e caso finalize algum curso
                        desejado ela possui graduação e pós-graduação.
                        <br>
                        <br>
                        As faculdades oferecem cursos mais específicos, com isso elas não possuem a mesma gama de
                        diversidade de cursos, atividades e pesquisas que uma universidade. Um ponto em comum entre elas
                        é que podem oferecer cursos de pós-graduação, mas em menor escala do que as universidades.

                    </p>

                </div>

                <div class="sub-title-descrit">
                    <h4>O QUE É UMA FACULDADE?</h4>
                </div>

                <div class="txt-descrit">
                    <p>São instituições de ensino superior que possuem o foco em formar profissionais capazes de atuar
                        na area que escolheram, assim proporcionado aos estudantes que completaram o ensino médio e que
                        queiram entrar em um curso específico pronto para o mercado de trabalho na sociedade, também
                        disponibilizam graduação e pós-graduação que acaba por deixar o currículo de um profissional
                        mais atrativo para o contratante. </p>
                </div>

                <div class="img-faculdade"></div>

                <div class="sub-title-descrit">
                    <h3>COMO FUNCIONA UMA FACULDADE?</h3>
                </div>

                <div class="txt-descrit">
                    <p>A função de uma faculdade é oferecer profissionais da educação responsáveis por dar aulas
                        teóricas e práticas disciplinares que estão no currículo da área escolhida, orientar e
                        acompanhar o desempenho dos estudantes, assim eles oferecem uma formação sólida e completa. Por
                        sua vez, os alunos têm que comparecer às aulas e realizar as atividades propostas por seus
                        professores, além de desenvolver o projeto de pesquisa e conclusão de curso, no qual ele vai ter
                        que colocar todos os conhecimentos aprendidos até então durante o curso. </p>

                    <p></p>
                </div>

                <div class="sub-title-descrit">
                    <h3>COMO ENTRAR EM UMA FACULDADE E QUAIS AS MAIS FAMOSAS?</h3>
                </div>

                <div class="txt-descrit">
                    <p>É necessário ter o ensino médio completo ou em fase de conclusão, devem apresentar os documentos
                        e preencher os requisitos da faculdade, podendo variar de uma instituição para outra. É
                        necessário participar de um processo seletivo realizado pelas faculdades, que podem ser por nota
                        do Enem, vestibular da instituição, boletim do ensino médio entre outras. Nem todas as
                        instituições de ensino superior terão o mesmo método e as mesmas opções para ingressar nela.</p>

                    <p>O Sisu (Sistema de Seleção Unificada) é um sistema no qual é gerenciado
                        pelo MEC (Ministério da Educação) no qual oferece vagas para os participantes
                        do Enem em instituições públicas de ensino superior que são parceiras do Sisu.
                        Possui uma única etapa de inscrição, sendo assim ele pode escolher as vagas
                        ofertadas, definindo se deseja concorrer a vagas concorridas ou as
                        destinadas a determinados grupos minoritários. Vale se lembrar de que pode
                        alterar o curso até que as inscrições sejam encerradas.
                    </p>
                    <p>
                        Após a inscrição e o prazo se encerrar, o sistema seleciona automaticamente os
                        mais bem classificados de cada curso, assim sendo classificado o número igual
                        ao de vagas abertas, caso for chamado para uma vaga você tem um prazo para fazer
                        a matrícula na area escolhida para confirmar a ocupação na vaga, também existe
                        uma lista de espera para as vagas que não foram ocupadas, para participar dessa
                        lista você tem que manifestar o seu interesse no cronograma que será
                        especificado.
                    </p>
                    <p>O Fundo de Financiamento Estudantil (FIES), ele é aberto duas vezes ao ano e é
                        um projeto do governo Federal onde ele financia de 50% a 100% do valor das mensalidades
                        durante o período que você estiver fazendo o curso, o governo cobra juros 0, não confunda
                        com bolsas de estudos afinal da faculdade você devera pagar ao governo o valor total em
                        parcelas, para passar no FIES, você deve cumprir algumas exigências que estão no portal.
                    </p>
                    <p>
                        Para ter acesso ao FIES é obrigatório se inscrever e passar em programa
                        seletivo vale-se ressaltar que ele é exclusivo para cursos superiores não
                        gratuitos e com uma boa avaliação no SINAES (Sistema Nacional de Avaliação
                        da Educação Superior), se o estudante passar ele devera pagar mensalmente
                        um encargo operacional fixado no contrato e o restante da mensalidade caso
                        não for integral, após 1 mês de conclusão do curso o valor financiado já
                        devera começar a ser pago.
                    </p>
                    <p>
                        A Universidade Estadual Paulista (Unesp) reúne todos os anos quase 100 mil
                        estudantes, o seu processo seletivo preenche vagas de 24 cidades paulistas,
                        contem 3 processos seletivos, sendo eles: Vestibular, Enem e Vestibular
                        via Olimpíadas Científicas. Para entrar via Enem a sua nota será avaliada
                        e tera um peso diferente variando de curso para curso, já para o
                        Vestibular serão 3 dias de provas, sendo divida em 2 fases, a primeira
                        fase tem 90 questões objetivas de conhecimentos gerais, a segunda fase,
                        no primeiro dia tem 12 questões discursivas especificas e o 2 dia da
                        segunda fase tem uma redação e 12 questões discursivas de linguagens
                        e códigos, por último o Vestibular via Olimpíadas Cientificas
                        é avaliado o desempenho por meio das competições nacionais e
                        internacionais a pontuação e definida conforme a medalha recebida,
                        sendo elas Bronze, Prata e Ouro.
                    </p>
                </div>
            </div>
        </section>


        <!--SOBRE BOLSAS DE ESTUDO-->
        <section class="bolsas" id="bolsas">
            <div class="sobre-descrit">
                <div class="title-descrit">
                    <h1 id="s-descrit">O que é uma bolsa de estudos e como funciona?</h1>
                </div>

                <div class="txt-descrit">
                    <p>
                        Quando um estudante não possui renda o suficiente para pagar uma faculdade ou alguma
                        instituição de ensino superior, uma das formas de ingressar na instituição desejada é
                        através das bolsas de estudo, assim uma entidade dá ao aluno uma contribuição parcial
                        ou total do valor da mensalidade, para que ele consiga entrar na faculdade e dar
                        conta das despesas.
                    </p>
                    <p>O mais comum em faculdade é por meio do pagamento parcial ou total da mensalidade
                        da instituição que pode ser durante todo o curso ou apenas um período, vale-se
                        lembrar que o governo pode emprestar o valor, mas devera ser devolvido
                        futuramente após a conclusão do curso, já a da própria instituição de ensino
                        superior, são valores reduzidos que o estudante não precisara devolver.
                    </p>

                </div>

                <div class="img-bolsas"></div>

                <div class="sub-title-descrit">
                    <h4>QUAIS OS TIPOS DE BOLSAS DE ESTUDOS </h4>
                </div>

                <div class="txt-descrit">

                    <div class="sub-descrit">
                        <h3>Existem vários tipos de bolsas de estudo, como:</h3>
                    </div>

                    <p><strong>Econômicas: </strong>A mais comum nas instituições de ensino superior,
                        é destinada a alunos com baixa renda e baixo poder aquisitivo para pagar o curso desejado.
                    </p>

                    <p><strong>Acadêmicas: </strong>Os alunos no qual possuem destaque nos estudos,
                        tem participação em pesquisas cientificas, podem tentar essa bolsa com alguns programas
                        disponíveis que são destinados a isso.</p>

                    <p><strong>Esportivas ou Artísticas: </strong>Algumas instituições têm bolsas para os
                        estudantes que tem destaque nos esportes ou na arte, as regras para esse tipo de bolsa
                        varia de instituição para instituição, o aluno deve comprovar que está envolvido com
                        arte e esporte para solicitar a bolsa.</p>

                    <p><strong>Descontos Gerais: </strong>Esse tipo de bolsa também é chamada de auxílio amplo,
                        ela é destinada às pessoas em geral, sem necessidade algo em específico e sem restrição.</p>
                </div>

                <div class="sub-title-descrit">
                    <h3>POR QUE AS BOLSAS DE ESTUDO SÃO IMPORTANTES? </h3>
                </div>

                <div class="txt-descrit">
                    <p>As bolsas servem para dar oportunidade aos estudante poderem estudar e se formar na
                        área que eles querem, isso é importante para que pessoas de baixa renda possam se
                        graduar e ter uma formação, assim abrindo um espaço maior no mercado de trabalho para
                        elas, além de uma qualificação que antes essa pessoa não iria ter devido ao poder
                        aquisitivo para entrar em uma instituição de ensino superior.
                    </p>

                    <p>Tem um grande auxílio para a educação da população já que abre mais oportunidades e portas
                        com os diferentes tipos de bolsa, para quem tem habilidades esportivas ou
                        artísticas também tem um grande reconhecimento, assim ganhando bolsas em instituições
                        especificas para poderem se formar.
                    </p>

                    <p>Muitas pessoas com mentes brilhantes em matemática, ciências e outras areas nao puderam se formar
                        por
                        causa de sua condição financeira, isso é uma solução para que mais pessoas possam concluir o
                        ensino superior assim tendo um maior número de indivíduos que frequentem a faculdade ou
                        universidade, assim tendo um menor número de desperdiço dessas mentes.

                    </p>

                </div>

            </div>
        </section>


        <!--SOBRE COTAS RACIAIS-->
        <section class="cotas" id="cotas">
            <div class="sobre-descrit">
                <div class="title-descrit">
                    <h1 id="s-descrit">O que são e como funcionam as cotas raciais?</h1>
                </div>

                <div class="txt-descrit">
                    <p>As cotas raciais são uma medida do governo contra a desigualdade, tem a função de diminuir a
                        diferença social, econômica e educacional, a sua obrigatoriedade é mais notada em setores
                        públicos, como nas faculdades, universidades e concursos públicos.</p>

                    <p> As cotas não se aplicam apenas as pessoas de cor, existe cota para indígena e seus descendentes
                        e para quilombolas, em alguns lugares existe uma cota separada para as pessoas pardas, ou são
                        inclusas na cota de destinadas às pessoas negras. Essa politica afirmativa é feita para garantir
                        o acesso desses grupos minoritários ao serviço publico.</p>

                    <p>As formas para garantir essa inclusão e acesso é a reserva de vagas para essas pessoas através da
                        cota ou vagas extras para o ingresso desse grupo nas instituições publicas e ao serviço publico.
                    </p>

                </div>

                <div class="img-cota">
                    <!-- <img src="/Src/assets/Imagens/cota-racial.jpeg" alt="Cota Racial"> -->
                </div>

                <div class="sub-title-descrit">
                    <h4>QUEM PODE CONCORRER ÁS VAGAS PARA COTAS RACIAIS?</h4>
                </div>

                <div class="txt-descrit">

                    <div class="sub-descrit">
                        <h3>Para concorrer às vagas, você precisa se encaixar em
                            duas condições obrigatórias:</h3>
                    </div>

                    <p><strong>- </strong>As que se autodeclaram pardas, negras ou indígenas, as que tem descendência
                        indígena e quilombola.</p>

                    <p><strong>- </strong>As pessoas que possuem direitos as cotas são as que estudaram os três anos do
                        ensino médio em escola pública.</p>

                    <p>Apesar de a Lei dizer que o critério de avaliação de raça é autodeclaratório, o Ministério da
                        Educação e a Secretaria Especial de Políticas de Promoção da Igualdade Racial podem realizar uma
                        investigação quanto a isso, caso exista denúncia de fraude. Se comprovada a falsificação, o
                        aluno pode perder a sua vaga.</p>
                </div>

            </div>
        </section>

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

    <!--JS-->
    <script src="../../Public/assets/Js/faculdade.js"></script>
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