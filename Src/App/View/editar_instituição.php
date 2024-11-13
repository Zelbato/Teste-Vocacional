<?php
require '../database/config.php';

// Recebe o id_instituicao da URL
if (isset($_GET['id_instituicao'])) {
    $id_instituicao = $_GET['id_instituicao'];
} else {
    echo "ID da instituição não fornecido.";
    exit();
}

// Código para processar a atualização quando o formulário é enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_fantasia = $_POST['nome_fantasia'];
    $cep = $_POST['cep'];
    $cnpj = $_POST['cnpj'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $razao_social = $_POST['razao_social'];
    $url = $_POST['url'];

    // Validação do CEP (exemplo: deve estar no formato XXXXX-XXX)
    if (!preg_match('/^\d{5}-\d{3}$/', $cep)) {
        echo "O CEP deve estar no formato XXXXX-XXX.";
        exit();
    }

    // Validação do CNPJ (exemplo: deve ter 14 dígitos)
    if (!preg_match('/^\d{14}$/', $cnpj)) {
        echo "O CNPJ deve conter 14 dígitos.";
        exit();
    }

    $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

    // Verificar se o CEP já existe na tabela `cep`
    $stmt = $conexao->prepare("SELECT id_cep FROM cep WHERE cep_numero = ?");
    $stmt->bind_param("s", $cep);
    $stmt->execute();
    $stmt->bind_result($id_cep);
    $stmt->fetch();
    $stmt->close();

    // Se o CEP não existir, insira-o
    if (empty($id_cep)) {
        $stmt = $conexao->prepare("INSERT INTO cep (cep_numero) VALUES (?)");
        $stmt->bind_param("s", $cep);
        if ($stmt->execute()) {
            $id_cep = $conexao->insert_id;
        }
        $stmt->close();
    }

    // Atualizar os dados da instituição na tabela `instituicao`
    $stmt = $conexao->prepare("UPDATE instituicao SET nome_fantasia = ?, id_cep = ?, cnpj = ?, email = ?, senha = ?, url = ?, razao_social = ? WHERE id_instituicao = ?");
    $stmt->bind_param("sisssssi", $nome_fantasia, $id_cep, $cnpj, $email, $hashedSenha, $url, $razao_social, $id_instituicao);

    if ($stmt->execute()) {
        header('Location: ../View/Instituição/instituicao.login.view.php');
    } else {
        echo "Erro ao atualizar a instituição: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"
        href="../../Public/assets/styles/PagInstituicao/EditarInst/editar.instituicao.css?v=<?php echo time(); ?>">

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
                <i class="fa-solid fa-bars"></i>
            </label>
        </div>

        <input type="checkbox" name="" id="chk1">

        <div class="logo">
            <h1><a href="instituicao.index.view.php" data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home" href="instituicao.index.view.php" id="inicio"  data-message="Opção de voltar para a pagina inicial">Inicio</a></li>
            <li><a id="#vocacional" href="../vocacao.view.php" id="destaque" data-message="Opção de ir  para o Teste Vocacional"><span class="teste">Teste
                        Vocacional</span></a>
            </li>
            <li><a id="#facul" href="i." id="eventos" data-message="Opção de ir para o sobre nós">Sobre Nós</a></li>
            <li><a id="#cadastro" href="instituicao.cadastro.php" id="eventos"  data-message="Opção de ir para o cadastro da sua conta">Cadastrar-se</a></li>
            <li><a class="mobile-excluir" href="login.view.php" data-message="Opção de entrar na sua conta">Entrar</a></li>

            <form action="../Services/deletar.php" method="POST">

                <li class="mobile-excluir"> <button data-message="Botão de excluir">Excluir</button> </li>

            </form>

            <a href="#" class="menu-button" data-message="Mais opções para o usuário">
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
            </a>
            <div class="tooltip">
                <div class="position">

                    <a href="" data-message="Opção de ir para o Login da sua conta">
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

                    <a href="instituicao.login.view.php" data-message="Opção de ir para o Login da instituição">


                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Deseja sair da Conta<br>
                                Clique aqui!
                            </span>

                            <span class="menu-item-content-subtitle">

                                Desconectar-se <br>

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
        <div class="title">
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
                            <button type="submit" class="close excluir" data-message="Botão de excluir">Excluir</button>
                        </div>
                    </form>
                </div>
            </div>

            <article class="container">
                <section class="form">
                    <form method="post">
                        <div class="form-content">

                            <div class="input-group">

                                <div class="input-box">
                                    <label for="nome_fantasia">Nome Fantasia</label>
                                    <input type="text" id="nome_fantasia" name="nome_fantasia"
                                        placeholder="Nome Fantasia" required>
                                </div>

                                <div class="input-box">
                                    <label for="url">URL da Instituição</label>
                                    <input type="url" id="url" name="url" placeholder="Digite a URL" required>
                                </div>

                                <div class="input-box">
                                    <label for="razao_social">Razão Social</label>
                                    <input type="text" id="razao_social" name="razao_social" placeholder="Razão Social"
                                        required>
                                </div>

                                <div class="input-box">
                                    <label for="cnpj">CNPJ</label>
                                    <input type="text" id="cnpj" name="cnpj" maxlength="14"
                                        placeholder="Digite seu CNPJ" required>
                                </div>
                                
                                <div class="input-box">
                                    <label for="email">E-mail</label>
                                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail"
                                        required>
                                </div>

                                <div class="input-box">
                                    <label for="cep">CEP</label>
                                    <input type="text" id="cep" name="cep" maxlength="9" placeholder="Digite seu CEP"
                                        required>
                                </div>

                                <div class="input-box">
                                    <label for="senha">Senha</label>
                                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha"
                                        required>
                                </div>

                                <aside class="continue-button">
                                    <button type="submit" data-message="Botão de salvar">Salvar</button>
                                </aside>
                    </form>
                </section>
            </article>
    </main>

    <!--RODAPÉ-->
    <footer>
        <div class="boxs">
            <h2>Logo</h2>

            <div class="logo">
                <h1><a href="index.view.php" data-message="Logo New Careers">New <span class="gradient">Careers</span>.</a></h1>
            </div>

        </div>
        <div class="boxs">
            <h2>Inicio</h2>
            <ul>
                <li><a href="index.view.php" data-message="Opção de voltar para a tela inicial">Home </a></li>
                <li><a href="vocacao.view.php" data-message="Opção de ir para o Teste Vocacional">Teste Vocacional </a></li>
                <li><a href="faculdade.view.php" data-message="Opção de ir para as Faculdades">Faculdades </a></li>
            </ul>
        </div>
        <div class="boxs">
            
            <h2>Suporte</h2>
            <ul>
                <li><a href="termos.view.php" data-message="Opção de ir para o Termos de uso">Termos de uso </a></li>
                <li><a href="politica.view.php" data-message="Opção de ir para a Politica de Privacidade">Política de Privacidade </a></li>
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

    <!--JS-->
    <script src="../../../Public/assets/Js/faculdade.js"></script>
    <!--JS-->
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
</body>

</html>