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
            <i class="fa-solid fa-bars"></i>
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="adm.view.php" data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
           <li><a id="#home" href="adm.view.php" id="inicio" data-message="Opção para voltar para a pagina inicial">Inicio</a></li>
            <li><a id="#vocacional" href="../vocacao.view.php" id="destaque"  data-message="Opção para ir  para o Teste Vocacional"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul" href="../faculdade.view.php" id="eventos" data-message="Opção para ir para as faculdades">Faculdades</a></li>
            <li><a id="#facul" href="../cadastro.view.php" id="eventos" data-message="Opção para ir para o cadastro da sua conta">Cadastrar-se</a></li>

            <li><a class="mobile-entrar" href="../login.view.php" id="eventos" data-message="Opção para entrar na sua conta">Entrar</a></li>

            <form action="../Services/deletar.php" method="POST">

                <li class="mobile-excluir"><button data-message="opção de excluir">Excluir</button></li>

            </form>

            <!-- <a href="#" class="menu-button" data-message="mais opções para o usuário">
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta--
            </a> 

            <div class="tooltip">
                <div class="position">

                    <a href="../editar_usuario.php">
                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Deseja editar seu usuário!
                            </span>

                            <span class="menu-item-content-subtitle">
                                <i class="fa-solid fa-pen-to-square"></i> Editar Usuário
                            </span>
                        </div>

                    </a>

                    <a href="../login.view.php">


                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Faça seu login!
                            </span>

                            <span class="menu-item-content-subtitle">
                                Login
                            </span>
                        </div>
                    </a>



                    <a href="../../Services/desconectar.php">


                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Deseja sair da Conta<br>
                            </span>

                            <span class="menu-item-content-subtitle">

                                Desconectar-se

                            </span>
                        </div>
                    </a>



                    <div class="menu-item-content">
                        <span class="menu-item-content-title">
                            Deseja excluir sua conta
                        </span>
                        <span id="myBtn" class="menu-item-content-subtitle">
                            Excluir conta
                        </span>
                    </div>
                </div>

        </ul> -->
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

        <section class="form-section">
            <h1 id="text">Adicionar CEP</h1>
            <form class="form" method="post">
                <label for="cep">CEP </label>
                <input type="text" id="cep" maxlength="9" name="cep" placeholder="Digite o CEP" required><br>


                <button type="submit" data-message="opção de adicionar cep">Adicionar CEP</button>
            </form>
        </section>

        <section class="careers-list " >
            <h2 id="text">CEPs Existentes</h2>
            <?php if ($ceps->num_rows > 0): ?>

                <div class="existente scroll">
                    <?php while ($cep = $ceps->fetch_assoc()): ?>
                        <div class="existente-content">

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
                <li><a href="" data-message="Opção para voltar para a tela inicial">Home </a></li>
                <li><a href="../vocacao.view.php" data-message="Opção para ir para o Teste Vocacional">Teste Vocacional </a></li>
                <li><a href="../faculdade.view.php" data-message="Opção para ir para as Faculdades">Faculdades </a></li>
            </ul>
        </div>
        <div class="boxs">
            <h2>Suporte</h2>
            <ul>
                <li><a href="../termos.view.php"  data-message="Opção para ir para o Termos de uso">Termos de uso </a></li>
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