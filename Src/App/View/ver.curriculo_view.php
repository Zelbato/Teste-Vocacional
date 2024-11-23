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
            height: 100vh;
            width: 100%;
            font-family: var(--font);
            background: var(--white);
        }

        .main {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px 20px;
            background: #fff;
            width: 100%;
            height: auto;
        }

        .main .curriculo {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 700px;
            height: auto;
            background: transparent;
        }

        .curriculo .curriculo-content {
            width: 100%;
            height: auto;
            border: 1px solid var(--black);
            padding: 40px;
        }

        
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
            /* border-radius: 50%;
            border: 2px solid #2a4d8f; */
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
            <i class="fa-solid fa-bars"></i>
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="index.view.php" data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home" href="index.view.php" id="inicio" data-message="Opção de voltar para a pagina inicial">Inicio</a></li>
            <li><a id="#vocacional" href="vocacao.view.php" id="destaque" data-message="Opção de ir  para o Teste Vocacional"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul" href="faculdade.view.php" id="eventos" data-message="Opção de ir para as faculdades">Faculdades</a></li>

            <li><a class="mobile-entrar" href="cadastro.view.php" id="eventos" data-message="Opção de entrar na sua conta">Entrar</a></li>
            <li><a class="mobile-excluir" href="#" id="eventos" data-message="Botão de excluir">Excluir conta</a></li>

            <a href="#" class="menu-button">
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

                        <a href="../editar_usuario.php" data-message="Opção de editar usuario">
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



                            <a href="curriculo.index.view.php" data-message="Opção de ir para criar o seu curriculo">
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
a


                            <a href="caminho.resultado.view.php" data-message="Opção de ir para a sua carreira obtida">
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
                            <a href="" data-message="Botão de cancelar">Cancelar</a></button>
                        <button type="submit" class="close excluir" data-message="Botão de excluir" >Excluir</button>
                    </div>
                </form>
            </div>
        </div>

            <section class="curriculo">
                <div class="curriculo-content">
                    <h2></h2>

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

                    
                </div>
            </section>
            <a href="../Services/baixar.curriculo.php?id=<?php echo $curriculo['id']; ?>">Baixar</a>
            <a href="Ecurriculo.view.php?id=<?php echo $curriculo['id']; ?>">Editar</a>
            <form action="../Services/deletar_curriculo.php" method="POST" style="display:inline;">
                <input type="hidden" name="id_curriculo" value="<?php echo $curriculo['id']; ?>">
                <button type="submit" onclick="return confirm('Tem certeza que deseja deletar este currículo?');">Deletar</button>
            </form>
            <div style="text-align: center; margin-top: 20px;">
                        <a href="Gerenciar.curriculo.php" style="color: #2a4d8f; text-decoration: none;">Voltar para Lista de Currículos</a>
                    </div>
        </main>

        <script src="../../Public/assets/Js/index.js"></script>

    <!-- <script src="../../Public/assets/Js/index_adm.js"></script> -->

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