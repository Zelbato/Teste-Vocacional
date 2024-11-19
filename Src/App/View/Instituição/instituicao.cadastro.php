<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Public/assets/styles/PagInstituicao/Cad_Instituicao/Cad.Instituicao.css">

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
                <form action="../../Services/cadastro.instituicao.php" method="POST">
                    <div class="form-header">
                        <div class="title">
                            <h1>Cadastro de Instituição</h1>
                        </div>
                        <!-- <div class="cursos-button">
                            <button> <a href="/Src/pages/cad_Cursos.html">Cursos</a> </button>
                        </div> -->
                    </div>

                    <div class="form-content">

                        <div class="input-group">

                            <div class="input-box">
                                <label for="nome_fantasia">Nome Fantasia</label>
                                <input id="nome_fantasia" type="text" name="nome_fantasia" placeholder="Nome Fantasia"
                                    required>
                            </div>

                            <div class="input-box">
                                <label for="url">URL da Instituição</label>
                                <input id="url" type="url" name="url" placeholder="Digite a URL" required>
                            </div>

                            <div class="input-box">
                                <label for="razao_social">Razão Social</label>
                                <input id="razao_social" type="text" name="razao_social" placeholder="Razão Social"
                                    required>
                            </div>

                            <div class="input-box">
                                <label for="cnpj">CNPJ </label>
                                <input id="cnpj" type="text" maxlength="14" name="cnpj" placeholder="Digite o CNPJ" required>
                            </div>


                            <div class="input-box">
                                <label for="email">Email </label>
                                <input id="email" type="email" name="email" placeholder="Digite seu E-mail" required>
                            </div>

                            <div class="input-box">
                                <label for="cep">CEP </label>
                                <input id="cep" type="text" maxlength="9" name="cep" placeholder="Digite seu CEP" required>
                            </div>

                            <div class="input-box">
                                <label for="senha">Senha</label>
                                <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required>
                                <!-- <div class="password-container">
                                    <input type="password" id="senha" placeholder="Sua senha" required>
                                    <button type="button" id="togglePassword" aria-label="Mostrar senha">
                                        <i class="fas fa-eye" id="passwordIcon"></i>
                                    </button>
                                </div> -->

                            </div>

                            <aside class="continue-button">
                                <button><a href="#" data-message="Botão de cadastrar">Cadastrar Instituição</a></button>
                            </aside>

                        </div>
                    </div>
                </form>
            </section>
        </article>
    </main>


    <script>
    
    //    const cnpjInput = document.getElementById('cnpj'); //CNPJ

    //     cnpjInput.addEventListener('input', () => {
    //         let cnpj = cnpjInput.value;

    //         // Remove caracteres que não sejam números
    //         cnpj = cnpj.replace(/\D/g, '');

    //         // Adiciona os separadores automaticamente
    //         if (cnpj.length > 2 && cnpj.length <= 5) {
    //             cnpj = cnpj.replace(/(\d{2})(\d+)/, '$1.$2');
    //         } else if (cnpj.length > 5 && cnpj.length <= 8) {
    //             cnpj = cnpj.replace(/(\d{2})(\d{3})(\d+)/, '$1.$2.$3');
    //         } else if (cnpj.length > 8 && cnpj.length <= 12) {
    //             cnpj = cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d+)/, '$1.$2.$3/$4');
    //         } else if (cnpj.length > 12) {
    //             cnpj = cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{1,2})/, '$1.$2.$3/$4-$5');
    //         }

    //         // Atualiza o valor no campo
    //         cnpjInput.value = cnpj;
    //     });

        const cepInput = document.getElementById('cep'); //CEP 

        cepInput.addEventListener('input', () => {
            let cep = cepInput.value;

            // Remove caracteres que não sejam números
            cep = cep.replace(/\D/g, '');

            // Adiciona o traço automaticamente após os 5 primeiros números
            if (cep.length > 5) {
                cep = cep.replace(/(\d{5})(\d+)/, '$1-$2');
            }

            // Atualiza o valor no campo
            cepInput.value = cep;
        });

        // const togglePassword = document.getElementById('togglePassword');
        // const passwordInput = document.getElementById('senha');
        // const passwordIcon = document.getElementById('passwordIcon');

        // togglePassword.addEventListener('click', () => {
        //     // Alterna o tipo do campo entre 'password' e 'text'
        //     const type = passwordInput.type === 'password' ? 'text' : 'password';
        //     passwordInput.type = type;

        //     // Alterna o ícone entre olho aberto e olho fechado
        //     if (type === 'password') {
        //         passwordIcon.classList.remove('fa-eye-slash');
        //         passwordIcon.classList.add('fa-eye');
        //     } else {
        //         passwordIcon.classList.remove('fa-eye');
        //         passwordIcon.classList.add('fa-eye-slash');
        //     }
        // });



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


    <script src="../../Public/assets/Global/Js/instituicaoGlobal.js"></script>
    <script src="../../Public/assets/styles/cadastro/cadastro.css"></script>

</body>

</html>