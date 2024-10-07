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
function marcarAutomaticamenteInstituicoesProximas($conexao, $user_id) {
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
    <link rel="stylesheet" href="../../../Public/assets/styles/ADM/InterligarCEP/interligar.cep.css">
    <title>Selecionar Instituições Próximas</title>
</head>
<body>
    <h1>Selecionar Instituições Próximas</h1>

    <form method="post">
        <h2>Selecione os CEPs:</h2>
        <ul>
            <?php while ($cep = $cep_result->fetch_assoc()): ?>
                <li>
                    <input type="checkbox" name="cep_selecionado[]" value="<?php echo $cep['id_cep']; ?>">
                    <?php echo htmlspecialchars($cep['cep_numero']); ?>
                </li>
            <?php endwhile; ?>
        </ul>

        <h2>Instituições disponíveis:</h2>
        <ul>
            <?php while ($instituicao = $result->fetch_assoc()): ?>
                <li>
                    <input type="checkbox" name="instituicao_proxima[]" value="<?php echo $instituicao['id_instituicao']; ?>">
                    <?php echo htmlspecialchars($instituicao['nome_fantasia']); ?> - CEP: <?php echo htmlspecialchars($instituicao['cep_numero']); ?>
                </li>
            <?php endwhile; ?>
        </ul>

        <button type="submit">Salvar Instituições Próximas</button>
    </form>
</body>
</html>