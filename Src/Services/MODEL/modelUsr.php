
<?php
class User {
    private $id_cadastro;
    private $nome;
    private $email;
    private $password;
    private $confirme_password;
    private $cep;
    private $data_nascimento;

    public function __construct($id_cadastro) {
        $this->id_cadastro = $id_cadastro;
    }

    public function register($name, $email, $password, $cep, $data_nascimento) {
        $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->id_cadastro->prepare($query);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $password);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->id_cadastro->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        return $stmt->fetch();
    }
}