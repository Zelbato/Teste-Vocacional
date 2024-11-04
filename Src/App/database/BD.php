CREATE TABLE IF NOT EXISTS carreira (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    id_cep INT,
    data_nascimento DATE NOT NULL,
    FOREIGN KEY (id_cep) REFERENCES cep(id_cep),
    nivel VARCHAR(90) NOT NULL DEFAULT 'user'
);

CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT NOT NULL,
    option_text VARCHAR(255) NOT NULL,
    carreira_id INT NOT NULL,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
    FOREIGN KEY (carreira_id) REFERENCES carreira(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS cep (
    id_cep INT AUTO_INCREMENT PRIMARY KEY,
    cep_numero VARCHAR(10) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS instituicao (
    id_instituicao INT AUTO_INCREMENT PRIMARY KEY,
    nome_fantasia VARCHAR(100) NOT NULL,
    id_cep INT,
    cnpj VARCHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    url VARCHAR(255), 
    razao_social VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_cep) REFERENCES cep(id_cep)
);

CREATE TABLE IF NOT EXISTS cursos (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,
    id_instituicao INT NOT NULL,
    nome_curso VARCHAR(100) NOT NULL,
    foto_curso VARCHAR(255), 
    duracao VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    carreira_id INT NOT NULL,
    FOREIGN KEY (id_instituicao) REFERENCES instituicao(id_instituicao) ON DELETE CASCADE,
    FOREIGN KEY (carreira_id) REFERENCES carreira(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS curriculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    foto_perfil varchar(255),
    endereco VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    experiencia TEXT NOT NULL,
    formacao TEXT NOT NULL,
    habilidades VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS user_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    question_id INT NOT NULL,
    option_id INT NOT NULL,
    carreira_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
    FOREIGN KEY (option_id) REFERENCES options(id) ON DELETE CASCADE,
    FOREIGN KEY (carreira_id) REFERENCES carreira(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS instituicao_cep_proximo (
    id_usuario INT NOT NULL,
    id_instituicao INT NOT NULL,
    cep_id INT NOT NULL,
    proximidade BOOLEAN,
    PRIMARY KEY (id_usuario, id_instituicao, cep_id),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_instituicao) REFERENCES instituicao(id_instituicao),
    FOREIGN KEY (cep_id) REFERENCES cep(id_cep)
);

-- Inserindo valores na tabela cep
INSERT INTO cep (cep_numero) VALUES ('15770-000');

