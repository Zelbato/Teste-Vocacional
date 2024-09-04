<?php
require 'config.php';
session_start(); // Iniciar a sessão deve ser feito logo no início do script

// Contagem das respostas e definição da carreira mais comum
$careers_count = [
    'math_teacher' => 0,
    'lawyer' => 0,
    'programmer' => 0
];

foreach ($_POST as $key => $value) {
    if (isset($careers_count[$value])) {
        $careers_count[$value]++;
    } 
}

$max_career = array_keys($careers_count, max($careers_count))[0];

// Mensagens para cada carreira
$careers_message = [
    'math_teacher' => 'Você tem perfil para ser um Professor de Matemática!',
    'lawyer' => 'Você tem perfil para ser um Advogado!',
    'programmer' => 'Você tem perfil para ser um Programador!'
];

echo $careers_message[$max_career];

?>
