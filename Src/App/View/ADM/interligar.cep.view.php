<?php
session_start();
require '../../database/config.php';

// Carrega todas as instituições e seus respectivos CEPs
$query = "
    SELECT i.id_instituicao, i.nome_fantasia, c.id_cep, c.cep_numero 
    FROM instituicao i
    JOIN cep c ON i.id_cep = c.id_cep
";
$result = $conexao->query($query);

// Carrega todos os CEPs disponíveis
$cep_query = "SELECT id_cep, cep_numero FROM cep";
$cep_result = $conexao->query($cep_query);

// Função para marcar automaticamente as instituições com CEPs iguais como próximas
function marcarAutomaticamenteInstituicoesProximas($conexao, $user_id)
{
    // Consulta que insere proximidade automaticamente quando os CEPs forem iguais
    $stmt = $conexao->prepare("
        INSERT INTO instituicao_cep_proximo (id_usuario, id_instituicao, cep_id, proximidade) 
        SELECT ?, i.id_instituicao, i.id_cep, TRUE
        FROM instituicao i
        WHERE EXISTS (
            SELECT 1 FROM cep c WHERE i.id_cep = c.id_cep
        )
        ON DUPLICATE KEY UPDATE proximidade = TRUE
    ");

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

// Marca automaticamente as instituições e CEPs iguais como próximos
marcarAutomaticamenteInstituicoesProximas($conexao, $_SESSION['id_usuario']);

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $instituicao_ids = $_POST['instituicao_proxima'] ?? [];
    $selected_ceps = $_POST['cep_selecionado'] ?? []; // CEPs selecionados

    // Atualiza as instituições próximas no banco
    foreach ($instituicao_ids as $instituicao_id) {
        foreach ($selected_ceps as $cep_id) {
            $stmt = $conexao->prepare("
                INSERT INTO instituicao_cep_proximo (id_usuario, id_instituicao, cep_id, proximidade) 
                VALUES (?, ?, ?, TRUE)
                ON DUPLICATE KEY UPDATE proximidade = TRUE
            ");
            $stmt->bind_param("iii", $_SESSION['id_usuario'], $instituicao_id, $cep_id);
            $stmt->execute();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Public/assets/styles/ADM/InterligarCEP/interligar.cep.css?v=<?php echo time(); ?>">

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

    <title>Selecionar Instituições Próximas</title>
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
            <h1><a href="../index.view.php">New <span class="gradient">Careers</span>.</a></h1>
        </div>

        <ul>
            <li><a id="#home" href="" id="inicio">Inicio</a></li>
            <li><a id="#vocacional" href="../vocacao.view.php" id="destaque"><span
                        class="teste">Teste Vocacional</span></a>
            </li>
            <li><a id="#facul" href="../faculdade.view.php" id="eventos">Faculdades</a></li>
            <li><a id="#facul" href="../cadastro.view.php" id="eventos">Cadastrar-se</a></li>

            <li><a class="mobile-entrar" href="../cadastro.view.php" id="eventos">Entrar</a></li>

            <form class="mobile-excluir" action="../Services/deletar.php" method="POST">

                <li class="mobile-excluir"><button>Excluir</button></li>

            </form>

            <a href="#" class="menu-button">
                <i class="fa-solid fa-user"></i> 
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
                    </div>
                </div>

        </ul>
    </header>

    <main class="main">
        <div class="container">
            <section class="select-prox">
                <h1>Selecionar Instituições Próximas</h1>

                <form method="post">
                    <h2>Selecione os CEPs:</h2>
                    <div class="Uselect scroll">
                        <?php while ($cep = $cep_result->fetch_assoc()): ?>
                            <div class="Iselect">
                                <input type="checkbox" name="cep_selecionado[]" value="<?php echo $cep['id_cep']; ?>">
                                <?php echo htmlspecialchars($cep['cep_numero']); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <h2>Instituições disponíveis:</h2>
                    <div class="Uselect scroll-2">
                        <?php while ($instituicao = $result->fetch_assoc()): ?>
                            <div class="Iselect">
                                <input type="checkbox" name="instituicao_proxima[]" value="<?php echo $instituicao['id_instituicao']; ?>">
                                <?php echo htmlspecialchars($instituicao['nome_fantasia']); ?> - CEP: <?php echo htmlspecialchars($instituicao['cep_numero']); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <button type="submit">Salvar Instituições Próximas</button>
                </form>
            </section>
    </main>

</body>

</html>