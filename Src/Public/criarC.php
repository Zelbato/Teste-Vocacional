<?php
require 'config.php';
require "ver_tipo.php";

session_start();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_name = $_POST['course_name'];
    $university_name = $_POST['university_name'];
    $course_url = $_POST['course_url'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $description = $_POST['description'];
    $careers = $_POST['careers'];

    // Início da transação para garantir a integridade dos dados
    $conexao->begin_transaction();

    try {
        // Adicionar o curso na tabela 'courses'
        $stmt = $conexao->prepare("INSERT INTO courses (course_name, university_name, course_url, description) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $course_name, $university_name, $course_url, $description);
        $stmt->execute();
        $course_id = $conexao->insert_id; // Obtém o ID do curso inserido

        // Adicionar a localização do curso na tabela 'locations'
        $stmt = $conexao->prepare("INSERT INTO locations (course_id, address, city, state, latitude, longitude) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issddd", $course_id, $address, $city, $state, $latitude, $longitude);
        $stmt->execute();

        // Adicionar a relação entre o curso e as carreiras na tabela 'course_careers'
        foreach ($careers as $career) {
            $stmt = $conexao->prepare("INSERT INTO course_careers (course_id, career) VALUES (?, ?)");
            $stmt->bind_param("is", $course_id, $career);
            $stmt->execute();
        }

        // Confirma a transação
        $conexao->commit();
        echo "Curso e localizações adicionados com sucesso!";
    } catch (Exception $e) {
        // Reverte a transação em caso de erro
        $conexao->rollback();
        echo "Erro ao adicionar o curso: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Curso</title>
</head>
<body>
    <h1>Adicionar Curso</h1>
    <form method="post" action="">
        <label for="course_name">Nome do Curso:</label>
        <input type="text" id="course_name" name="course_name" required><br>

        <label for="university_name">Nome da Universidade:</label>
        <input type="text" id="university_name" name="university_name" required><br>

        <label for="course_url">URL do Curso:</label>
        <input type="text" id="course_url" name="course_url" required><br>

        <label for="description">Descrição:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="address">Endereço:</label>
        <input type="text" id="address" name="address" required><br>

        <label for="city">Cidade:</label>
        <input type="text" id="city" name="city" required><br>

        <label for="state">Estado:</label>
        <input type="text" id="state" name="state" required><br>

        <label for="latitude">Latitude:</label>
        <input type="text" id="latitude" name="latitude" required><br>

        <label for="longitude">Longitude:</label>
        <input type="text" id="longitude" name="longitude" required><br>

        <label for="careers">Carreiras Relacionadas:</label>
        <select id="careers" name="careers[]" multiple required>
            <option value="math_teacher">Professor de Matemática</option>
            <option value="lawyer">Advogado</option>
            <option value="programmer">Programador</option>
        </select><br>

        <button type="submit">Adicionar Curso</button>
    </form>
</body>
</html>
