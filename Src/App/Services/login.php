<?php
session_start();
require_once "../database/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $name = $_POST['name'];

    $sql = 'SELECT id_usuario, senha, nivel FROM usuario WHERE email = ? AND name = ?';
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $email, $name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario, $hashedSenha, $nivel);
        $stmt->fetch();

        if (password_verify($senha, $hashedSenha)) {
            $_SESSION['nivel'] = $nivel;
            $_SESSION['id_usuario'] = $id_usuario;
            
            if ($nivel === 'admin') {
                header("Location: ../View/ADM/adm.view.php"); 
                exit(); 

            } else {
                echo "Login bem-sucedido! Nível de acesso: " . $_SESSION['nivel'];
                header("Location: ../View/index.view.php");
            }
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }



    $stmt->close();
    $conexao->close();
}
?>
