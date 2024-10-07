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
    header("Location: ver_resultado.php?carreira_id=$suggested_career");
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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/styles/NewCareers/NewQuiz.css">

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
            <li><a id="#vocacional" href="vocacao.view.php" id="destaque"><span class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul" href="faculdade.view.php" id="eventos">Faculdades</a></li>

            <li><a class="mobile-entrar" href="cadastro.view.php" id="eventos">Entrar</a></li>
            <li><a class="mobile-excluir" href="./ADM/index_Adm.html" id="eventos">Excluir conta</a></li>

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
    <!-- <div id="loader"></div> -->

    <main class="main">
    <section class="quiz-section">
        <div class="quiz">
            <h1>Teste Vocacional</h1>
            <form method="post" action="" id="quizForm">
                <?php foreach ($questions as $question_id => $question): ?>
                    <div class="question" style="display: none;">
                        <h2 class="question-text"><?php echo htmlspecialchars($question['text']); ?></h2>
                        <div class="option-list">
                            <?php foreach ($question['options'] as $option): ?>
                                <input type="radio" id="option<?php echo $option['id']; ?>" name="question_<?php echo $question_id; ?>" value="<?php echo $option['id']; ?>" required>
                                <label for="option<?php echo $option['id']; ?>"><?php echo htmlspecialchars($option['text']); ?></label><br>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="quiz-footer">
                    <span class="question-total">1 / <?php echo count($questions); ?> Questões</span>
                    <div class="nav-buttons">
                        <button type="button" id="prev" disabled>Anterior</button>
                        <button type="button" id="next">Próximo</button>
                    </div>
                </div>
                <button type="submit" style="display: none;" id="submit">Enviar Respostas</button>
            </form>
        </div>

        <div class="result-box" style="display: none;">
            <h2>Resultado do Teste</h2>
            <div class="result-container">
                <span class="score-text">Você acertou 0 de <?php echo count($questions); ?></span>
            </div>
        </div>
    </section>
</main>

    <footer>
        <div class="boxs">
            <h2>Logo</h2>
            <div class="logo">
                <h1><a href="index.view.php">New <span class="gradient">Careers</span>.</a></h1>
            </div>
        </div>
        <div class="boxs">
            <h2>Inicio</h2>
            <ul>
                <li><a href="index.view.php">Home</a></li>
                <li><a href="vocacao.view.php">Teste Vocacional</a></li>
                <li><a href="faculdade.view.php">Faculdades</a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="termos.view.php">Termos de uso</a></li>
                <li><a href="politica.view.php">Política de Privacidade</a></li>
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
        <p>© 2024 New Careers. Todos os direitos reservados.</p>
    </div>

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
    document.addEventListener('DOMContentLoaded', function() {
        const questions = <?php echo json_encode($questions); ?>; // Captura as perguntas do PHP
        let currentQuestionIndex = 0;
        let score = 0;

        // Função para carregar a pergunta atual
        function loadQuestion() {
            const questionElements = document.querySelectorAll('.question');
            questionElements.forEach((el, index) => {
                el.style.display = (index === currentQuestionIndex) ? 'block' : 'none';
            });

            // Atualiza o total de questões
            document.querySelector('.question-total').textContent = `${currentQuestionIndex + 1} / ${questions.length} Questões`;

            // Atualiza os botões
            document.getElementById('prev').disabled = currentQuestionIndex === 0;
            document.getElementById('next').style.display = (currentQuestionIndex === questions.length - 1) ? 'none' : 'inline-block';
            document.getElementById('submit').style.display = (currentQuestionIndex === questions.length - 1) ? 'inline-block' : 'none';
        }

        // Evento para o botão "Próximo"
        document.getElementById('next').addEventListener('click', function() {
            const selectedOption = document.querySelector(`input[name="question_${currentQuestionIndex}"]:checked`);
            if (selectedOption) {
                currentQuestionIndex++;
                loadQuestion();
            } else {
                alert('Por favor, selecione uma opção!');
            }
        });

        // Evento para o botão "Anterior"
        document.getElementById('prev').addEventListener('click', function() {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                loadQuestion();
            }
        });

        // Evento para enviar as respostas
        document.getElementById('quizForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita o envio padrão do formulário
            // Aqui você pode processar as respostas e mostrar os resultados
            // Implementar lógica para calcular o resultado
            // Exibir a caixa de resultados
            document.querySelector('.quiz').style.display = 'none';
            document.querySelector('.result-box').style.display = 'block';
            // Exemplo de exibição de resultados
            document.querySelector('.score-text').textContent = `Você acertou ${score} de ${questions.length}`;
        });

        // Carregar a primeira pergunta
        loadQuestion();
    });
</script>

    <!-- <script src="../../Public/assets/Js/NewCareers/newCareers.js"></script>
    <script src="../../Public/assets/Js/NewCareers/newCareers.quest.js"></script> -->
</body>

</html>