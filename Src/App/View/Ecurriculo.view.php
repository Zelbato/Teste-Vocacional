<?php
require '../database/config.php';

// Verificar conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Verificar se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Garantir que o ID seja um número
    $stmt = $conexao->prepare("SELECT * FROM curriculos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resul = $stmt->get_result();
    $curriculo = $resul->fetch_assoc();
    $stmt->close();
} else {
    die("ID do currículo não fornecido.");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../Public/assets/styles/curriculo/Editar.css">

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
            <h1><a href="index.view.php">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home inicio" href="index.view.php">Inicio</a></li>
            <li><a id="#vocacional destaque" href="vocacao.view.php"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul eventos" href="faculdade.view.php">Faculdades</a></li>
            <li><a id="#cadastro cadastrar" href="cadastro.view.php">Cadastrar-se</a></li>
            <li><a class="mobile-excluir" href="login.view.php">Entrar</a></li>

            <form class="mobile-excluir" action="../Services/deletar.php" method="POST">
                <li class="mobile-excluir"> <button>Excluir</button> </li>
            </form>

            <li><a class="mobile-excluir" href="curriculo.index.view.php" id="eventos">Criar curriculo</a></li>
            <li><a class="mobile-excluir" href="caminho.resultado.view.php" id="eventos">Ver carreiras</a></li>

            <a href="#" class="menu-button">
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
            </a>

            <div class="tooltip">
                <div class="position">
                    <div class="position">

                        <a href="login.view.php">
                            <div class="menu-item-content">
                                <span class="menu-item-content-title">
                                    Faça seu login<br>
                                    Clique aqui!
                                </span>

                                <span class="menu-item-content-subtitle">
                                    Entrar <br>
                                </span>
                            </div>
                        </a>

                        <br>

                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Deseja excluir sua conta <br>
                                Clique aqui!
                            </span>

                            <span id="myBtn" class="menu-item-content-subtitle">
                                excluir conta
                            </span>

                            <br>

                            <a href="curriculo.index.view.php">
                                <div class="menu-item-content">
                                    <span class="menu-item-content-title">
                                        Crie seu Curriculo<br>
                                        Clique aqui!
                                    </span>

                                    <span class="menu-item-content-subtitle">
                                        Criar Curriculo <br>
                                    </span>
                                </div>
                            </a>

                            <br>

                            <a href="caminho.resultado.view.php">
                                <div class="menu-item-content">
                                    <span class="menu-item-content-title">
                                        Veja as carreiras obtidas<br>

                                    </span>

                                    <span class="menu-item-content-subtitle">
                                        Ver Carreiras <br>
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

        <!--Editar Curriculo -->

        <main class="main">
            <!-- <h1>Editar Currículo</h1> -->
            <section class="Editar">
                <?php if ($curriculo): ?>
                    <form action="../Services/salvar_curriculo.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($curriculo['id']); ?>">

                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($curriculo['nome']); ?>" required><br>

                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($curriculo['email']); ?>" required><br>

                        <label for="telefone">Telefone:</label>
                        <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($curriculo['telefone']); ?>" required><br>

                        <label for="endereco">Endereço:</label>
                        <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($curriculo['endereco']); ?>" required><br>

                        <label for="experiencia">Experiência:</label><br>
                        <textarea id="experiencia" name="experiencia" rows="5" required><?php echo htmlspecialchars($curriculo['experiencia']); ?></textarea><br>

                    </form>
            </section>

            <section class="Editar">
                <form action="../Services/salvar_curriculo.php" method="POST" enctype="multipart/form-data">
                    <label for="formacao">Formação:</label><br>
                    <textarea id="formacao" name="formacao" rows="5" required><?php echo htmlspecialchars($curriculo['formacao']); ?></textarea><br>

                    <label for="habilidades">Habilidades:</label>
                    <input type="text" id="habilidades" name="habilidades" value="<?php echo htmlspecialchars($curriculo['habilidades']); ?>"><br>

                    <!-- Exibir foto atual se existir -->
                    <?php if (!empty($curriculo['foto_perfil'])): ?>
                        <label for="foto_atual">Foto de Perfil Atual:</label><br>
                        <img src="<?php echo htmlspecialchars($curriculo['foto_perfil']); ?>" alt="Foto de perfil" width="150"><br>
                    <?php endif; ?>

                    <label for="foto_perfil">Atualizar Foto de Perfil:</label>
                    <input type="file" id="foto_perfil" name="foto_perfil"><br><br>

                    <button type="submit">Salvar Currículo</button>
               
            <?php else: ?>
                <p>Currículo não encontrado.</p>
            <?php endif; ?>
 </form>
            </section>
        </main>


     
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
</body>

</html>