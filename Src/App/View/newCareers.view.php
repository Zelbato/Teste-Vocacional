<?php
session_start();
require '../database/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id_usuario'];

    // Para contabilizar a quantidade de opções selecionadas para cada carreira
    $career_count = [];

    foreach ($_POST as $question_id => $option_id) {
        $option_id = intval($option_id);

        // Obtém a carreira associada a essa opção
        $stmt = $conexao->prepare("SELECT carreira_id FROM options WHERE id = ?");
        $stmt->bind_param("i", $option_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $career_id = $row['carreira_id'];

        // Armazena a resposta do usuário
        $stmt = $conexao->prepare("INSERT INTO user_responses (user_id, question_id, option_id, carreira_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiii", $user_id, $question_id, $option_id, $career_id);
        $stmt->execute();

        // Conta quantas vezes essa carreira foi selecionada
        if (!isset($career_count[$career_id])) {
            $career_count[$career_id] = 0;
        }
        $career_count[$career_id]++;
    }

    // Determina a carreira mais escolhida
    arsort($career_count); // Ordena de forma decrescente
    $suggested_career = key($career_count); // Carreira com mais respostas

    // Redireciona para a página de resultado, passando a carreira sugerida
    header("Location: P1result.view.php?carreira_id=$suggested_career");
    exit();
}

// Carrega questões e opções
$query = "SELECT q.id as question_id, q.question_text, o.id as option_id, o.option_text, o.carreira_id 
          FROM questions q 
          LEFT JOIN options o ON q.id = o.question_id 
          ORDER BY q.id, o.id";
$result = $conexao->query($query);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $question_id = $row['question_id'];
    if (!isset($questions[$question_id])) {
        $questions[$question_id] = [
            'text' => $row['question_text'],
            'options' => []
        ];
    }
    $questions[$question_id]['options'][] = [
        'id' => $row['option_id'],
        'text' => $row['option_text']
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/styles/NewCareers/NewQuiz.css?v=<?php echo time(); ?>">
    <!-- Icones Bootstrap-->
     <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
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

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <!--Bootstrap -->
    <title>Teste Vocacional</title>

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
            <h1><a href="index.view.php" data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home inicio" href="index.view.php" data-message="Opção para voltar para a pagina inicial">Inicio</a></li>
            <li><a id="#vocacional destaque" href="vocacao.view.php" data-message="Opção para ir  para o Teste Vocacional"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul eventos" href="faculdade.view.php"  data-message="Opção para ir para as faculdades" >Faculdades</a></li>
            <li><a id="#cadastro cadastrar" href="cadastro.view.php"  data-message="Opção para ir para o cadastro da sua conta">Cadastrar-se</a></li>

            <li><a class="mobile-excluir" href="#" id="eventos" data-message="Opção de excluir conta">Excluir conta</a></li>
            <li><a class="mobile-excluir" href="curriculo.view.php" id="eventos" data-message="Opção para criar o seu curriculo">Criar curriculo</a></li>
            <li><a class="mobile-excluir" href="caminho.resultado.view.php" id="eventos"  data-message="Opção para ver a sua carreira">Ver carreiras</a></li>

            <a href="#" class="menu-button" data-message="mais opções para o usuário">
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
            </a>

            <div class="tooltip">
                <div class="position">
                    <div class="position">

                        <a href="login.view.php" data-message="Opção de ir para o Login da sua conta">
                            <div class="menu-item-content">
                                <span class="menu-item-content-title">
                                    Faça seu login
                                    Clique aqui!
                                </span>

                                <span class="menu-item-content-subtitle">
                                    Entrar
                                </span>
                            </div>
                        </a>

                        <a href="../editar_usuario.php" data-message="opção de editar usuario"> 
                            <div class="menu-item-content">
                                <span class="menu-item-content-title">
                                    Deseja editar seu usuário!
                                </span>

                                <span class="menu-item-content-subtitle">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar Usuário
                                </span>
                            </div>

                        </a>

                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Deseja excluir sua conta
                                Clique aqui!
                            </span>

                            <span id="myBtn" class="menu-item-content-subtitle">
                                excluir conta
                            </span>



                            <a href="curriculo.index.view.php" data-message="opção de ir para criar o seu curriculo">
                                <div class="menu-item-content">
                                    <span class="menu-item-content-title">
                                        Crie seu Curriculo
                                        Clique aqui!
                                    </span>

                                    <span class="menu-item-content-subtitle">
                                        Criar Curriculo
                                    </span>
                                </div>
                            </a>



                            <a href="caminho.resultado.view.php" data-message="opção para ir para a sua carreira obtida">
                                <div class="menu-item-content">
                                    <span class="menu-item-content-title">
                                        Veja as carreiras obtidas

                                    </span>

                                    <span class="menu-item-content-subtitle">
                                        Ver Carreiras
                                    </span>
                                </div>
                            </a>


                        </div>
                    </div>

        </ul>
    </header>

    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    <main class="main">
        <section class="quiz-career">
            <div class="container">
                <div class="title-vocacional">
                    <h1>Teste Vocacional</h1>
                </div>
                <form id="quizForm" method="POST" action="">
                    <?php foreach ($questions as $question_id => $question): ?>
                        <div class="question" id="question-<?php echo $question_id; ?>">

                            <div class="title">
                                <p><?php echo htmlspecialchars($question['text']); ?></p>
                            </div>

                            <div class="options">
                                <?php foreach ($question['options'] as $option): ?>
                                    <input type="radio" id="option<?php echo $option['id']; ?>" name="<?php echo $question_id; ?>" value="<?php echo $option['id']; ?>" required>
                                    <label for="option<?php echo $option['id']; ?>"><?php echo htmlspecialchars($option['text']); ?></label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <button type="button" class="btn" id="nextBtn" onclick="showNextQuestion()">Próxima</button>
                    <button type="submit" class="btn" id="submitBtn" style="display:none;">Enviar Respostas</button>
                </form>
            </div>
        </section>
    </main>

    <!--RODAPÉ-->
    <footer>
        <div class="boxs">
            <h2>Logo</h2>

            <div class="logo">
                <h1><a href="index.view.php" data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
            </div>


            <!-- <h2>Criadores</h2>
           <p>Desenvolvido por <a href="https://github.com/Zelbato/">Heitor Zelbato</a>
           <p>Desenvolvido por <a href="https://github.com/Zelbato/">Calebe Farias</a>
           <p>Desenvolvido por <a href="https://github.com/Zelbato/">Eduardo Rodrigues </a>
           <p>Desenvolvido por <a href="https://github.com/Zelbato/"> João Gianini </a> -->
            </p>
        </div>
        <div class="boxs">
            <h2>Inicio</h2>
            <ul>
                <li><a href="index.view.php" data-message="Opção para voltar para a tela inicial">Home </a></li>
                <li><a href="vocacao.view.php" data-message="Opção para ir para o Teste Vocacional">Teste Vocacional </a></li>
                <li><a href="faculdade.view.php" data-message="Opção para ir para as Faculdades">Faculdades </a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="termos.view.php" data-message="Opção para ir para o Termos de uso">Termos de uso </a></li>
                <li><a href="politica.view.php" data-message="Opção para ir para a Politica de Privacidade">Política de Privacidade </a></li>
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

    <script src="../../Public/assets/js/index.js"></script>
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

    <script>
        let currentQuestion = 0;
        const questions = document.querySelectorAll('.question');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');

        // Mostrar a primeira pergunta
        questions[currentQuestion].classList.add('active');

        function showNextQuestion() {
            // Verifica se alguma opção foi selecionada
            const selectedOption = questions[currentQuestion].querySelector('input[type="radio"]:checked');
            if (!selectedOption) {
                alert('Por favor, selecione uma opção.');
                return;
            }

            // Oculta a pergunta atual
            questions[currentQuestion].classList.remove('active');
            currentQuestion++;

            // Verifica se ainda há mais perguntas
            if (currentQuestion < questions.length) {
                questions[currentQuestion].classList.add('active');
            } else {
                // Oculta o botão "Próxima" e mostra o botão "Enviar"
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'inline-block';
            }
        }
    </script>

</body>

</html>