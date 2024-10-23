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
    <title>Currículo de <?php echo htmlspecialchars($curriculo['nome']); ?></title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            color: #333; 
            margin: 0; 
            padding: 20px;
            background-color: #f4f7fa;
        }
        h1, h2 {
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
            border-radius: 50%;
            border: 2px solid #2a4d8f;
        }
    </style>
</head>
<body>
    <h1>Currículo de <?php echo htmlspecialchars($curriculo['nome']); ?></h1>

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

    <div style="text-align: center; margin-top: 20px;">
        <a href="lista_curriculos.php" style="color: #2a4d8f; text-decoration: none;">Voltar para Lista de Currículos</a>
    </div>
</body>
</html>
