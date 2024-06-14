<?php
class RegisterController {
    private $modelUsr;

    public function __construct(User $modelUsr) {
        $this->modelUsr = $modelUsr;
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $cep = $_POST['cep'];
            $data_nascimento = $_POST['data_nascimento'];
            if ($this->modelUsr->register($name, $email, $password, $cep, $data_nascimento)) {
                header('Location: cadastro.php');
                exit;
            } else {
                $error = 'Erro ao cadastrar usuário';
            }
        }
        require_once 'views/register.php';
    }
}

