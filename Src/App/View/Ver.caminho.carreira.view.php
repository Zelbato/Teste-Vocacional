<?php
session_start();
require '../database/config.php';

$user_id = $_SESSION['id_usuario'];
$carreira_id = $_GET['carreira_id']; // Presume-se que o ID da carreira seja passado por parâmetro na URL

// Consulta para buscar o caminho percorrido (perguntas e respostas) do usuário para uma carreira específica
$query = "
    SELECT q.question_text AS question_text, o.option_text AS option_text
    FROM user_responses ur
    JOIN options o ON ur.option_id = o.id
    JOIN questions q ON ur.question_id = q.id
    WHERE ur.user_id = ? AND ur.carreira_id = ?";

$stmt = $conexao->prepare($query);
$stmt->bind_param("ii", $user_id, $carreira_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/styles/NewCareers/Resultado/caminho.resultado.css?v=<?php echo time(); ?>">

    <!-- Icones Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Icones Bootstrap -->

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <title>Caminho para a Carreira</title>
</head>

<body>
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
    <li><a id="#facul" href="#" id="eventos">Faculdades</a></li>

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

    </div>

</ul>
</header>

<main class="main ">
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
        <section class="ver-caminho">
            <h1>Caminho para a Carreira</h1>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div>
                    <p><strong>Pergunta:</strong> 
                        <?php echo isset($row['question_text']) ? htmlspecialchars($row['question_text']) : 'Texto da pergunta não encontrado'; ?>
                    </p>
                    <p><strong>Resposta:</strong> 
                        <?php echo isset($row['option_text']) ? htmlspecialchars($row['option_text']) : 'Texto da resposta não encontrado'; ?>
                    </p>
                </div>
                <hr>
            <?php endwhile; ?>

            <?php if ($result->num_rows === 0): ?>
                <p>Nenhuma resposta encontrada para esta carreira.</p>
            <?php endif; ?>
        </section>
    </main>

</body>
</html>
