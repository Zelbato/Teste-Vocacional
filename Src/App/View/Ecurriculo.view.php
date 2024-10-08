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

        <!--Editar Curriculo -->

        <main class="main">
            <section class="Editar">
                <h1>Editar Currículo</h1>
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
                    </form>
                <?php else: ?>
                    <p>Currículo não encontrado.</p>
                <?php endif; ?>

            </section>
        </main>


        <!--RODAPÉ-->
        <footer>
            <div class="boxs">
                <h2>Logo</h2>

                <div class="logo">
                    <h1><a href="index.view.php">New <span class="gradient">Careers</span>.</a></h1>
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
                    <li><a href="index.view.php">Home </a></li>
                    <li><a href="vocacao.view.php">Teste Vocacional </a></li>
                    <li><a href="faculdade.view.php">Faculdades </a></li>
                </ul>
            </div>
            <div class="boxs">
                <h2>Suporte</h2>
                <ul>
                    <li><a href="termos.view.php">Termos de uso </a></li>
                    <li><a href="politica.view.php">Política de Privacidade </a></li>
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