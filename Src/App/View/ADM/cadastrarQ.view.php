<?php

session_start();
require '../../database/config.php';

// Verifica se o usuário tem nível de acesso "admin"
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 'admin') {
    header("Location: ../View/login.view.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_text = $_POST['question_text'];
    $options = $_POST['options'];

    // Inserir questão
    $stmt = $conexao->prepare("INSERT INTO questions (question_text) VALUES (?)");
    $stmt->bind_param("s", $question_text);
    $stmt->execute();
    $question_id = $conexao->insert_id;

    // Inserir opções
    foreach ($options as $option) {
        $stmt = $conexao->prepare("INSERT INTO options (question_id, option_text, carreira_id) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $question_id, $option['text'], $option['carreira_id']);
        $stmt->execute();
    }

    echo "<div class='alert alert-success'>Questão e opções adicionadas com sucesso!</div>";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Public/assets/styles/questoes/questoes.css?v=<?php echo time(); ?>">

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
    <title>Adicionar Questão</title>
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
 //mito 
        <ul>
            <li><a id="#home" href="../index.view.php" id="inicio" data-message="Opção de voltar para a pagina inicial">Inicio</a></li>
            <li><a id="#vocacional" href="vocacao.view.php" id="destaque"  data-message="Opção de ir  para o Teste Vocacional"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul" href="../faculdade.view.php" id="eventos" data-message="Opção de ir para as faculdades">Faculdades</a></li>
            <li><a href="../cadastro.view.php">Cadastrar-se</a></li>

            <li><a class="mobile-excluir" href="../cadastro.view.php" id="eventos" data-message="Opção de ir para o cadastro da sua conta">Cadastrar-se</a></li>
            <li><a class="mobile-excluir" href="../cadastro.view.php" id="eventos" data-message="Opção de entrar na sua conta">Entrar</a></li>
            <li><a class="mobile-excluir" href="../faculdade.view.php" id="eventos" data-message="Botão de excluir">Excluir conta</a></li>

            <a href="#" class="menu-button" data-message="Mais opções para o usuário">
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
            </a>

            <div class="tooltip">
                <div class="position">
                    <a href="cadastro.view.php" data-message="Opção de cadastar-se">


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
                        <button class="btn-default">
                            <a href="" data-message="Botão de cancelar">Cancelar</a></button>
                        <button type="submit" class="close excluir" data-message="Botão de excluir">Excluir</button>
                    </div>
                </form>
            </div>
        </div>

        <article class="container">
            <section class="form">
                <h1>Adicionar Nova Questão</h1>
                <form method="post" action="">
                    <div class="input-box txt-quest">
                        <label for="question_text">Texto da Questão:</label>
                        <input type="text" class="txt-quest" id="question_text" name="question_text" placeholder="Digite a pergunta" required>
                    </div>

                    <!-- <h3>Opções:</h3> -->
                    <?php
                    // Buscar carreiras para os selects
                    $carreiras_query = "SELECT id, nome FROM carreira";
                    $carreiras_result = $conexao->query($carreiras_query);

                    for ($i = 0; $i < 4; $i++) {
                        echo '<div class="option-group">';
                        echo '<div class="input-box txt-option">';
                        echo '<label>Opção ' . ($i + 1) . ':</label>';
                        echo '<input type="text" name="options[' . $i . '][text]" placeholder="Texto da opção" required>';
                        echo '</div>';
                        echo '<div class="input-box">';
                        echo '<label>Carreira:</label>';
                        echo '<select name="options[' . $i . '][carreira_id]" required>';
                        while ($carreira = $carreiras_result->fetch_assoc()) {
                            echo "<option value='{$carreira['id']}'>{$carreira['nome']}</option>";
                        }
                        // Resetar o ponteiro da consulta para reutilizar o resultado no próximo loop
                        $carreiras_result->data_seek(0);
                        echo '</select>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>

                    <button type="submit" class="btn-submit" data-message="Botão de salvar">Salvar Questão</button>
                </form>
            </section>
        </article>
    </main>

    <!--RODAPÉ-->
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
                <li><a href="" data-message="Opção de voltar para a tela inicial">Home </a></li>
                <li><a href="../vocacao.view.php" data-message="Opção de ir para o Teste Vocacional">Teste Vocacional </a></li>
                <li><a href="../faculdade.view.php" data-message="Opção de ir para as Faculdades">Faculdades </a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="../termos.view.php" data-message="Opção de ir para o Termos de uso">Termos de uso </a></li>
                <li><a href="../politica.view.php" data-message="Opção de ir para a Politica de Privacidade">Política de Privacidade </a></li>
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