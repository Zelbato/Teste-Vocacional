<?php
require '../database/config.php';

$id = $_GET['id'] ?? null;

// Verifica se o ID foi passado
if (!$id) {
    echo "ID do currículo não foi fornecido!";
    exit();
}

// Busca o currículo no banco de dados
$stmt = $conexao->prepare("SELECT * FROM curriculos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$curriculo = $result->fetch_assoc();
$stmt->close();
$conexao->close();

// Verifica se o currículo foi encontrado
if (!$curriculo) {
    echo "Currículo não encontrado!";
    exit();
}

// Verifica se a foto de perfil existe
$foto_perfil = !empty($curriculo['foto_perfil']) ? $curriculo['foto_perfil'] : null;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <title>Teste Vocacional</title>
    <title>Currículo de <?php echo htmlspecialchars($curriculo['nome']); ?></title>
    <style>
        @import '../../Public/assets/Global/style/index.css';
        @import '../../Public/assets/Global/style/header/header-2.css';
        @import '../../Public/assets/Global/style/footer/footer.css';

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        body {
            font-family: var(--font);
            color: #333;
            margin: 0;
            background-color: #f4f7fa;
        }

        h1,
        h2 {
            color: #2a4d8f;
            text-align: center;
            border-bottom: 2px solid #2a4d8f;
            padding-bottom: 5px;
        }

        .section {
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid #2a4d8f;
            border-radius: 10px;
            background-color: #ffffff;
        }

        .info {
            margin-bottom: 10px;
        }

        .section h2 {
            font-size: 20px;
            color: #2a4d8f;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 0;
        }

        .section p {
            font-size: 14px;
            line-height: 1.5;
            color: #333;
        }

        .label {
            color: #2a4d8f;
            font-weight: bold;
        }

        .contact-info {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .photo {
            text-align: center;
            margin-bottom: 20px;
        }

        .photo img {
            max-width: 150px;
            border-radius: 50%;
            border: 2px solid #2a4d8f;
        }
    </style>
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
                <img class="icon" id="icon-mobile" src="../../Public/assets/Imagens/cardapio.png" alt="">
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


                    </div>
                </div>

        </ul>
    </header>

    <!--PAG-1-->
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
            <section class="curriculo">
                <div class="curriculo-content">
                    <article class="parte-1">

                    </article>

                    <article class="parte-2">

                    </article>
                </div>
            </section>
        </main>

        <h1><?php echo htmlspecialchars($curriculo['nome']); ?></h1>

        <?php if ($foto_perfil): ?>
            <div class="photo">
                <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil">
            </div>
        <?php endif; ?>

        <div class="section contact-info">
            <div><span class="label">Nome:</span> <?php echo htmlspecialchars($curriculo['nome']); ?></div>
            <div><span class="label">Endereço:</span> <?php echo htmlspecialchars($curriculo['endereco']); ?></div>
            <div><span class="label">Email:</span> <?php echo htmlspecialchars($curriculo['email']); ?></div>
            <div><span class="label">Telefone:</span> <?php echo htmlspecialchars($curriculo['telefone']); ?></div>
        </div>

        <div class="section">
            <h2>Experiência</h2>
            <p><?php echo nl2br(htmlspecialchars($curriculo['experiencia'])); ?></p>
        </div>

        <div class="section">
            <h2>Formação</h2>
            <p><?php echo nl2br(htmlspecialchars($curriculo['formacao'])); ?></p>
        </div>

        <div class="section">
            <h2>Habilidades</h2>
            <p><?php echo htmlspecialchars($curriculo['habilidades']); ?></p>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="Gerenciar.curriculo.php" style="color: #2a4d8f; text-decoration: none;">Voltar para Lista de Currículos</a>
        </div>
</body>

</html>