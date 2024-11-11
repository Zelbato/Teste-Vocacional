<?php
require_once "../database/config.php";

// Recebe o usuario_id da URL
if (isset($_GET['usuario_id'])) {
    $usuario_id = $_GET['usuario_id'];
} else {
    echo "ID do usuário não fornecido.";
    exit();
}

// Código para processar a atualização quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cep = $_POST['cep'];
    $data_nascimento = $_POST['data_nascimento'];

    // Validação do CEP (exemplo: deve estar no formato XXXXX-XXX)
    if (!preg_match('/^\d{5}-\d{3}$/', $cep)) {
        echo "O CEP deve estar no formato XXXXX-XXX.";
        exit();
    }

    // Verificar se o CEP já existe na tabela cep
    $sql_cep = 'SELECT id_cep FROM cep WHERE cep_numero = ?';
    $stmt_cep = $conexao->prepare($sql_cep);
    $stmt_cep->bind_param("s", $cep);
    $stmt_cep->execute();
    $result_cep = $stmt_cep->get_result();

    if ($result_cep->num_rows > 0) {
        $row = $result_cep->fetch_assoc();
        $id_cep = $row['id_cep'];
    } else {
        $sql_insert_cep = 'INSERT INTO cep (cep_numero) VALUES (?)';
        $stmt_insert_cep = $conexao->prepare($sql_insert_cep);
        $stmt_insert_cep->bind_param("s", $cep);
        if ($stmt_insert_cep->execute()) {
            $id_cep = $stmt_insert_cep->insert_id;
        } else {
            echo "Erro ao inserir o CEP: " . $stmt_insert_cep->error;
            exit();
        }
        $stmt_insert_cep->close();
    }

    $stmt_cep->close();

    $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

    // Atualizar informações do usuário
    $sql_update = 'UPDATE usuario SET name = ?, email = ?, senha = ?, id_cep = ?, data_nascimento = ? WHERE id_usuario = ?';
    $stmt_update = $conexao->prepare($sql_update);
    $stmt_update->bind_param("sssssi", $name, $email, $hashedSenha, $id_cep, $data_nascimento, $usuario_id);

    if ($stmt_update->execute()) {
        echo "Usuário atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar usuário: " . $stmt_update->error;
    }

    $stmt_update->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../Public/assets/styles/ADM/Eusuario/usuario.css">
    
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
       

    <title>Editar Usuário</title>
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
            <li><a id="#home" href="index.view.php" id="inicio">Inicio</a></li>
            <li><a id="#vocacional" href="vocacao.view.php" id="destaque"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul" href="faculdade.view.php" id="eventos">Faculdades</a></li>
            <li><a id="#cadastro cadastrar" href="cadastro.view.php">Cadastrar-se</a></li>
            <li><a class="mobile-excluir" href="login.view.php">Entrar</a></li>

            <form action="../Services/deletar.php" method="POST">

                <li class="mobile-excluir"> <button>Excluir</button> </li>

            </form>

            <li><a class="mobile-excluir" href="curriculo.index.view.php" id="eventos">Criar curriculo</a></li>
            <li><a class="mobile-excluir" href="caminho.resultado.view.php" id="eventos">Ver carreiras</a></li>


            <a href="#" class="menu-button" data-message="mais opções para o usuário">
                <i class="fa-solid fa-user"></i> <!--Cadastrar-se ou <br> Excluir conta -->
            </a>
            <div class="tooltip">
                <div class="position">
                    <div class="position">

                        <a href="login.view.php">
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



                        <div class="menu-item-content">
                            <span class="menu-item-content-title">
                                Deseja excluir sua conta
                                Clique aqui!
                            </span>

                            <span id="myBtn" class="menu-item-content-subtitle">
                                excluir conta
                            </span>



                            <a href="curriculo.index.view.php">
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



                            <a href="caminho.resultado.view.php">
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

    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="quadro">
            <div class="title-pop">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h2 id="titulo">Confirmação</h2>
            </div>

            <div class="pgf">
                <p>Deseja realmente excluir essa conta? Essa opção apagará todos seus dados até agora</p>
                <br>
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
   <div class="title">
    <h1 >Editar Usuário</h1></div>
    <form class="form-main" method="post">
        <section class="Editar">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" pattern="\d{5}-\d{3}" title="Formato: XXXXX-XXX" required><br><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br><br>

        <button type="submit">Salvar</button>
    </section></form></main>
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

    <!--JS-->
    <script src="../../Public/assets/Js/faculdade.js"></script>
    <!--JS-->
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
