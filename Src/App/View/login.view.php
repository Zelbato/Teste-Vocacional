<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/styles/login/login.css?v=<?php echo time(); ?>"><!-- ../../Public/assets/styles/login/login.css -->

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
   

    <main class="main">
        <article class="container">
            <section class="form-image">
                <div class="title-form">
                    <h1>Faça seu login <br> e explore nosso sistema!</h1>
                </div>
                <img src="../../Public/assets/Img/Connected world-pana.png" alt="Imagem ilustrativa de tres pessoas usando o celular" loading="lazy">
            </section>

            <section class="form">
                <form action="../Services/login.php" method="POST">
                    <div class="form-header">
                        <div class="title">
                            <h1>Entrar</h1>
                        </div>

                        <div class="login-button">
                            <button> <a href="./Instituição/instituicao.login.view.php" data-message="Botão de ir para Login de instituição">Instituição</a> </button>
                        </div>

                    </div>

                    <div class="input-group">
                        <div class="input-box">
                            <label for="name">Nome</label>
                            <input id="name" type="text" name="name" placeholder="Digite seu nome" required>
                        </div>


                        <div class="input-box">
                            <label for="email">Email</label>
                            <input id="email" type="text" name="email" placeholder="Digite seu email" required>
                        </div>

                        <div class="input-box">
                            <label for="password">Senha</label>
                            <input id="password" type="password" name="senha" placeholder="Digite sua senha" required>
                        </div>

                        <!-- <div class="recuperar-senha">
                            <a href="recuperarS.view.php" data-message="opção de ir para recuperar a senha">Esqueceu sua senha?</a>
                        </div> -->
                    </div>

                    <aside class="continue-button">
                        <button><a href="#" data-message="Botão para entrar na sua conta">Entrar</a></button>
                    </aside>

                    <div class="cadastre">
                        <a href="cadastro.view.php">Cadastrar-se</a>
                    </div>

                </form>
            </section>
        </article>
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
    <script src="../../Public/assets/Js/login.js"></script>

</body>

</html>