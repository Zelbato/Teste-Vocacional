<?php
session_start();
require '../../database/config.php';

// Verifica se o usuário tem nível de acesso "admin"
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 'admin') {
    header("Location: ../View/login.view.php");
    exit();
}

// Adicionar carreira
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome_carreira'])) {
    $nome_carreira = trim($_POST['nome_carreira']);

    // Verifica se a carreira já existe
    $stmt = $conexao->prepare("SELECT COUNT(*) FROM carreira WHERE nome = ?");
    $stmt->bind_param("s", $nome_carreira);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo "<div class='alert error'>A carreira '$nome_carreira' já existe!</div>";
    } else {
        // Se a carreira não existir, insere no banco de dados
        $stmt = $conexao->prepare("INSERT INTO carreira (nome) VALUES (?)");
        $stmt->bind_param("s", $nome_carreira);

        if ($stmt->execute()) {
            echo "<div class='alert success'>Carreira adicionada com sucesso!</div>";
        } else {
            echo "<div class='alert error'>Erro ao adicionar carreira: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }
}

// Excluir carreira
if (isset($_GET['delete'])) {
    $id_carreira = $_GET['delete'];
    $stmt = $conexao->prepare("DELETE FROM carreira WHERE id = ?");
    $stmt->bind_param("i", $id_carreira);

    if ($stmt->execute()) {
        echo "<div class='alert success'>Carreira excluída com sucesso!</div>";
    } else {
        echo "<div class='alert error'>Erro ao excluir carreira: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

// Carregar todas as carreiras
$result = $conexao->query("SELECT * FROM carreira");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Carreiras</title>
    <link rel="stylesheet" href="../../../Public/assets/styles/ADM/GerenCarreira/gerenciar.carreira.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <h1><a href="../index.view.php">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="inicio" href="">Inicio</a></li>
            <li><a id="destaque" href="../vocacao.view.php"><span class="teste">Teste Vocacional</span></a></li>
            <li><a id="eventos" href="../faculdade.view.php">Faculdades</a></li>
            <li><a id="eventos" href="../cadastro.view.php">Cadastrar-se</a></li>
            <li><a class="mobile-entrar" href="../cadastro.view.php" id="eventos">Entrar</a></li>

            <form action="../Services/deletar.php" method="POST">
                <li class="mobile-excluir"><button>Excluir</button></li>
            </form>

            <a href="#" class="menu-button">
                <i class="fa-solid fa-user"></i>
            </a>

            <div class="tooltip">
                <div class="position">
                    <a href="../login.view.php">
                        <div class="menu-item-content">
                            <span class="menu-item-content-title">Clique aqui para fazer seu login!</span>
                            <span class="menu-item-content-subtitle">Login</span>
                        </div>
                    </a>

                    <br>

                    <a href="../login.view.php">
                        <div class="menu-item-content">
                            <span class="menu-item-content-title">Deseja sair da Conta<br>Clique aqui!</span>
                            <span class="menu-item-content-subtitle">Desconectar-se <br></span>
                        </div>
                    </a>

                    <br>

                    <div class="menu-item-content">
                        <span class="menu-item-content-title">Deseja excluir sua conta <br>Clique aqui para finalizar!</span>
                        <span id="myBtn" class="menu-item-content-subtitle">excluir conta</span>
                    </div>
                </div>
            </div>
        </ul>
    </header>

    <main class="main">
        <div id="myModal" class="modal">
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
            <h2 id="text">Adicionar Carreira</h2>
            <form method="post">
                <label for="nome_carreira">Nome da Carreira:</label>
                <input type="text" id="nome_carreira" name="nome_carreira" required>
                <button type="submit">Adicionar</button>
            </form>
        </section>

        <section class="careers-list">
            <h2 id="text">Carreiras Atuais</h2>
            <ul>
                <?php while ($carreira = $result->fetch_assoc()): ?>
                    <li>
                        <?php echo htmlspecialchars($carreira['nome']); ?>
                        <a href="gerenCarreira.view.php?delete=<?php echo $carreira['id']; ?>" class="delete-button" onclick="return confirm('Tem certeza que deseja excluir esta carreira?');">
                            <i class="bi bi-trash"></i> Excluir
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </section>
    </main>

    <footer>
        <div class="boxs">
            <h2>Logo</h2>
            <div class="logo">
                <h1><a href="../index.view.php">New <span class="gradient">Careers</span>.</a></h1>
            </div>
        </div>
        <div class="boxs">
            <h2>Inicio</h2>
            <ul>
                <li><a href="../index.view.php">Home </a></li>
                <li><a href="../vocacao.view.php">Teste Vocacional </a></li>
                <li><a href="../faculdade.view.php">Faculdades </a></li>
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
            <p>Somos uma empresa brasileira focada em encontrar a melhor área de atuação para nossos usuários e indicar as redes de ensino mais próximas dele.</p>
        </div>
    </footer>

    <div class="footer">
        <p>Copyright © 2024 New Careers. Todos os direitos reservados.</p>
    </div>

    <script src="../../../Public/assets/js/index.js"></script>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script src="../../Public/assets/Js/gerenciar_carreiras.js"></script>
</body>
</html>
