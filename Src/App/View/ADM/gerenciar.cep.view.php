<?php
require '../../database/config.php';

// Verifica se o usuário está logado como administrador
session_start();
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'admin') {
    echo "Acesso negado!";
    exit();
}

// Se o formulário de adição foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cep'])) {
    $cep = $_POST['cep'];

    // Validação do CEP (deve estar no formato XXXXX-XXX)
    if (!preg_match('/^\d{5}-\d{3}$/', $cep)) {
        echo "O CEP deve ser no formato XXXXX-XXX.";
        exit();
    }

    // Insere o CEP na tabela
    $stmt = $conexao->prepare("INSERT INTO cep (cep_numero) VALUES (?)");
    $stmt->bind_param("s", $cep);

    if ($stmt->execute()) {
        echo "CEP adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar o CEP: " . $stmt->error;
    }

    $stmt->close();
}

// Se o formulário de exclusão foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_cep_id'])) {
    $cep_id = intval($_POST['delete_cep_id']);

    // Deleta o CEP da tabela
    $stmt = $conexao->prepare("DELETE FROM cep WHERE id_cep = ?");
    $stmt->bind_param("i", $cep_id);

    if ($stmt->execute()) {
        echo "CEP excluído com sucesso!";
    } else {
        echo "Erro ao excluir o CEP: " . $stmt->error;
    }

    $stmt->close();
}

// Consulta os CEPs existentes
$cep_query = "SELECT id_cep, cep_numero FROM cep";
$ceps = $conexao->query($cep_query);

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Public/assets/styles/ADM/GerenCEP/gerenciar.cep.css?v=<?php echo time(); ?>">

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
    <title>Adicionar e Gerenciar CEPs</title>
</head>

<body>

    <header class="header">

        <div class="menu-mobile">
            <label for="chk1" onclick="menu()">
                <img class="icon" id="icon-mobile" src="../../../Public/assets/Img/cardapio.png" alt="">
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="../index.view.php">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home" href="../index.view.php" id="inicio">Inicio</a></li>
            <li><a id="#vocacional" href="vocacao.view.php" id="destaque"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul" href="../faculdade.view.php" id="eventos">Faculdades</a></li>

            <li><a class="mobile-entrar" href="../cadastro.view.php" id="eventos">Entrar</a></li>
            <li><a class="mobile-excluir" href="../faculdade.view.php" id="eventos">Excluir conta</a></li>

            <a href="#" class="menu-button">
                <i class="fa-solid fa-user"></i> Cadastrar-se ou <br> Excluir conta --
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
                            <a href="">Cancelar</a></button>
                        <button type="submit" class="close excluir">Excluir</button>
                    </div>
                </form>
            </div>
        </div>

        <section class="form-section">
            <h1 id="text">Adicionar CEP</h1>
            <form class="form" method="post">
                <label for="cep">CEP </label>
                <input type="text" id="cep" maxlength="9" name="cep" placeholder="Digite o CEP" required><br>
                

                <button type="submit">Adicionar CEP</button>
            </form>
        </section>

        <section class="careers-list">
            <h2 id="text">CEPs Existentes</h2>
            <?php if ($ceps->num_rows > 0): ?>
                <div class="ul_existente">
                    <?php while ($cep = $ceps->fetch_assoc()): ?>
                        <div class="li_existente">
                            <?php echo htmlspecialchars($cep['cep_numero']); ?>
                            <!-- Formulário para deletar o CEP -->
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="delete_cep_id" value="<?php echo $cep['id_cep']; ?>">
                                <button type="submit">Deletar</button>
                            </form>
                    </div>
                    <?php endwhile; ?>
                    </div>
            <?php else: ?>
                <p>Nenhum CEP cadastrado.</p>
            <?php endif; ?>

            <a href="interligar.cep.view.php">Interligação</a>
        </section>
    </main>

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