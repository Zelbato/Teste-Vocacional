<?php
require '../database/config.php';
require_once '../../dompdf-3.0.0/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// Obtém o ID do currículo
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID do currículo não fornecido.";
    exit();
}

// Consulta o banco de dados para buscar os dados do currículo
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

// Define o diretório base para as imagens
$base_dir = realpath(__DIR__ . '/../../../uploads');

// Extrai o nome do arquivo da foto e monta o caminho seguro
$foto_perfil = basename($curriculo['foto_perfil'] ?? '');
$path = $base_dir . '/' . $foto_perfil;

// Valida e processa a imagem da foto de perfil
if ($foto_perfil && file_exists($path) && is_readable($path) && strpos($path, $base_dir) === 0) {
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    $foto_html = '
    <div class="photo">
        <img src="' . $base64 . '" alt="Foto de Perfil">
    </div>';
} else {
    $foto_html = '<div class="photo">Foto não disponível</div>';
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
            font-family: "Segoe UI", Arial, sans-serif; 
            color: #333; 
            margin: 0; 
            padding: 20px;
            background-color: #f9f9f9;
        }
        h1, h2 {
            color: #1e5aa4;
            text-align: center;
            border-bottom: 3px solid #1e5aa4;
            padding-bottom: 10px;
        }
        h1 {
            font-size: 28px;
        }
        h2 {
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .section {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .section p {
            font-size: 15px;
            line-height: 1.6;
            color: #555;
        }
        .contact-info {
            padding: 10px 20px;
            background-color: #e9f2fb;
            border: 1px solid #1e5aa4;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .contact-info div {
            margin-bottom: 10px;
        }
        .label {
            color: #1e5aa4;
            font-weight: bold;
        }
        .photo {
            text-align: center;
            margin-bottom: 20px;
        }
        .photo img {
            max-width: 150px;
            height: auto;
            border-radius: 50%;
            border: 4px solid #1e5aa4;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }
        .section-title {
            font-size: 20px;
            color: #1e5aa4;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #ddd;
        }
        .info {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1></h1>';

// Adiciona a foto de perfil, se existir
$html .= $foto_html;

$html .= '
    <div class="contact-info">
        <div><span class="label">Nome:</span> ' . htmlspecialchars($curriculo['nome']) . '</div>
        <div><span class="label">Endereço:</span> ' . htmlspecialchars($curriculo['endereco']) . '</div>
        <div><span class="label">Email:</span> ' . htmlspecialchars($curriculo['email']) . '</div>
        <div><span class="label">Telefone:</span> ' . htmlspecialchars($curriculo['telefone']) . '</div>
    </div>

    <div class="section">
        <h2 class="section-title">Experiência</h2>
        <p>' . nl2br(htmlspecialchars($curriculo['experiencia'])) . '</p>
    </div>

    <div class="section">
        <h2 class="section-title">Formação</h2>
        <p>' . nl2br(htmlspecialchars($curriculo['formacao'])) . '</p>
    </div>

    <div class="section">
        <h2 class="section-title">Habilidades</h2>
        <p>' . nl2br(htmlspecialchars($curriculo['habilidades'])) . '</p>
    </div>
</body>
</html>
';


// Gera o PDF usando o DOMPDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
ob_clean();
$dompdf->stream('curriculo_' . $id . '.pdf', array("Attachment" => true));
?>
