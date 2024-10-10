<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Public/assets/styles/PagInstituicao/Log_Instituicao/Login.instituicao.css">

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
    <title>Teste Vocacional</title>
</head>

<body>

    <main class="main">
        <article class="container">
            <!-- <section class="form-image">
                <img src="/Src/assets/Imagens/imagemLogin.svg" alt="image">
            </section> -->

            <section class="form">
                <form action="../../Services/login.instituicao.php" method="POST">
                    <div class="form-header">
                        <div class="title">
                            <h1>Login de Instituição</h1>
                        </div>
                        <!-- <div class="cursos-button">
                            <button> <a href="/Src/pages/cad_Cursos.html">Cursos</a> </button>
                        </div> -->
                    </div>

                    <div class="input-group">
                        
                        <div class="input-box">
                            <label for="email">Email </label>
                            <input id="email" type="email" name="email" placeholder="Digite seu E-mail" required>
                        </div>

                        <div class="input-box">
                            <label for="senha">Senha</label>
                            <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required>
                         
                        </div>
                    </div>

                    <aside class="continue-button">
                        <button><a href="#">Entrar</a></button>
                    </aside>
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
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    
    <script src="../../Public/assets/Global/Js/instituicaoGlobal.js"></script>
    <script src="../../Public/assets/styles/cadastro/cadastro.css"></script>

</body>

</html>