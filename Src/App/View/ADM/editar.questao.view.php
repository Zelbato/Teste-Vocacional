<?php
session_start();
require '../../database/config.php';

// Verifica se o usuário tem nível de acesso 'admin'
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 'admin') {
    header("Location: ../View/login.view.php");
    exit();
}

// Verifica se o ID da questão foi passado
if (!isset($_GET['id'])) {
    die('ID da questão não fornecido.');
}

$question_id = intval($_GET['id']);

// Atualiza a questão e suas opções
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question_text'])) {
    $question_text = $_POST['question_text'];
    if (!empty($question_text)) {
        $stmt = $conexao->prepare("UPDATE questions SET question_text = ? WHERE id = ?");
        $stmt->bind_param("si", $question_text, $question_id);
        $stmt->execute();
    } else {
        echo "<div class='alert alert-warning'>O texto da questão não pode estar vazio.</div>";
    }

    // Atualiza as opções e as carreiras associadas
    if (isset($_POST['option_text']) && isset($_POST['carreira'])) {
        foreach ($_POST['option_text'] as $option_id => $option_text) {
            $carreira_id = $_POST['carreira'][$option_id];
            if (!empty($option_text) && !empty($carreira_id)) {
                $stmt = $conexao->prepare(
                    "UPDATE options SET option_text = ?, carreira_id = ? WHERE id = ?"
                );
                $stmt->bind_param("sii", $option_text, $carreira_id, $option_id);
                $stmt->execute();
            }
        }
    }
    header("Location: editar_quest.php?id=$question_id");
    exit();
}

// Obtém o texto da questão
$stmt = $conexao->prepare("SELECT question_text FROM questions WHERE id = ?");
$stmt->bind_param("i", $question_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die('Questão não encontrada.');
}
$question = $result->fetch_assoc();

// Obtém as opções associadas à questão
$stmt = $conexao->prepare("SELECT id, option_text, carreira_id FROM options WHERE question_id = ?");
$stmt->bind_param("i", $question_id);
$stmt->execute();
$options_result = $stmt->get_result();
$options = $options_result->fetch_all(MYSQLI_ASSOC);

// Obtém todas as carreiras para o select
$carreira_result = $conexao->query("SELECT id, nome FROM carreira");
$carreiras = $carreira_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Public/assets/styles/ADM/Editarquest/editar.questao.css?v=<?php echo time(); ?>">
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Bootstrap-->
    <title>Editar Questão e Opções</title>
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
            <h1><a href="../index.view.php" data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home" href="../index.view.php" id="inicio"  data-message="Opção para voltar para a pagina inicial">Inicio</a></li>
            <li><a id="#vocacional" href="vocacao.view.php" id="destaque" data-message="Opção para ir  para o Teste Vocacional"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul" href="../faculdade.view.php" id="eventos" data-message="Opção para ir para as faculdades">Faculdades</a></li>
            <li><a href="../cadastro.view.php"  data-message="Opção para ir para o cadastro da sua conta">Cadastrar-se</a></li>

            <li><a class="mobile-excluir" href="../cadastro.view.php" id="eventos" data-message="Opção para entrar na sua conta">Entrar</a></li>
            <li><a class="mobile-excluir" href="../faculdade.view.php" id="eventos" data-message="opção de excluir">Excluir conta</a></li>

            <a href="#" class="menu-button" data-message="mais opções para o usuário">
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
            </a>

            <div class="tooltip">
                <div class="position">
                    <a href="cadastro.view.php" data-message="opção de cadastrar-se">


                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Ainda não se cadastrou?
                                Clique aqui para se cadastrar!
                            </span>

                            <span class="menu-item-content-subtitle">

                                Cadastrar-se 
                                Login
                            </span>
                        </div>
                    </a>

                    

                    <div class="menu-item-content">
                        <span class="menu-item-content-title">
                            Deseja excluir sua conta 
                            Clique aqui para finalizar!
                        </span>
                        <span id="myBtn" class="menu-item-content-subtitle">
                            excluir conta
                        </span>
                    </div>
                </div>
            </div>
        </ul>
    </header>

    <main class="main">
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="quadro">
                <div class="title-pop">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <h2 id="titulo">Confirmação</h2>
                </div>

                <div class="pgf">
                    <p>Deseja realmente excluir essa conta? Essa opção apagará todos seus dados até agora</p>
                    <p><span>Atenção:</span> Essa ação não poderá ser desfeita.</p>
                </div>

                <form action="../../Services/deletar.php" method="POST">
                    <div id="btn-pop">
                        <button class="btn-default" data-message="opção de cancelar">
                            <a href="" data-message="opção de cancelar">Cancelar</a></button>
                        <button type="submit" class="close excluir" data-message="opção de excluir">Excluir</button>
                    </div>
                </form>
            </div>
        </div>

        <article class="container">
            <section class="form">
                <h1>Editar Questão</h1>

                <form method="post" action="">
                    <div class="input-box txt-quest">
                        <label for="question_text">Texto da Questão:</label>
                        <input type="text" id="question_text" name="question_text" value="<?php echo htmlspecialchars($question['question_text']); ?>" required>
                    </div>

                    <h2>Opções da Questão</h2>
                    <?php foreach ($options as $option): ?>
                        <div class="option-group">
                            <div class="input-box txt-option">
                                <label for="option<?php echo $option['id']; ?>">Opção:</label>
                                <input type="text" id="option<?php echo $option['id']; ?>" name="option_text[<?php echo $option['id']; ?>]" value="<?php echo htmlspecialchars($option['option_text']); ?>" required>
                            </div>

                            <div class="input-box">
                                <label for="carreira<?php echo $option['id']; ?>">Carreira:</label>
                                <select class="carreira-option" id="carreira<?php echo $option['id']; ?>" name="carreira[<?php echo $option['id']; ?>]">
                                    <?php foreach ($carreiras as $carreira): ?>
                                        <option value="<?php echo $carreira['id']; ?>" <?php if ($option['carreira_id'] == $carreira['id']) echo 'selected'; ?>>
                                            <?php echo htmlspecialchars($carreira['nome']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <button type="submit" class="btn-submit" data-message="opção de salvar alterações">Salvar Alterações</button>
                </form>

                <a href="gerenciar.questao.view.php" class="back-link" data-message="opção de voltar para gerenciar questões">Voltar para Gerenciar Questões</a>
            </section>
        </article>
    </main>

    <footer>
        <div class="boxs">
            <h2>Logo</h2>

            <div class="logo">
                <h1><a href="" data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
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
                <li><a href="" data-message="Opção para voltar para a tela inicial">Home </a></li>
                <li><a href="../vocacao.view.php" data-message="Opção para ir para o Teste Vocacional">Teste Vocacional </a></li>
                <li><a href="../faculdade.view.php" data-message="Opção para ir para as Faculdades">Faculdades </a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="../termos.view.php" data-message="Opção para ir para o Termos de uso">Termos de uso </a></li>
                <li><a href="../politica.view.php" data-message="Opção para ir para a Politica de Privacidade">Política de Privacidade </a></li>
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

    <script src="../../../Public/assets/Js/index_adm.js"></script>

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