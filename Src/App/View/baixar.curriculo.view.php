<?php
require '../database/config.php';

// require_once '../../dompdf/autoload.inc.php';  tirar do comentario

use Dompdf\Dompdf;

// $id = $_GET['id']; Tirar do comentario

$stmt = $conexao->prepare("SELECT * FROM curriculos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$curriculo = $result->fetch_assoc();
$stmt->close();
$conexao->close();

if (!$curriculo) {
    echo "Currículo não encontrado!";
    exit();
}

// HTML do currículo para gerar o PDF
$html = '
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Currículo de ' . htmlspecialchars($curriculo['nome']) . '</title>
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
    </style>
</head>
<body>
    <h1>Currículo de ' . htmlspecialchars($curriculo['nome']) . '</h1>

    <div class="section contact-info">
        <div><span class="label">Nome:</span> ' . htmlspecialchars($curriculo['nome']) . '</div>
        <div><span class="label">Email:</span> ' . htmlspecialchars($curriculo['email']) . '</div>
        <div><span class="label">Telefone:</span> ' . htmlspecialchars($curriculo['telefone']) . '</div>
    </div>

    <div class="section">
        <h2>Experiência</h2>
        <p>' . nl2br(htmlspecialchars($curriculo['experiencia'])) . '</p>
    </div>

    <div class="section">
        <h2>Formação</h2>
        <p>' . nl2br(htmlspecialchars($curriculo['formacao'])) . '</p>
    </div>
</body>
</html>
';

// Gera o PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
ob_clean();
$dompdf->stream('curriculo_' . $id . '.pdf', array("Attachment" => true));
?>
