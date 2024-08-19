
    <!-- tabela do usuario 
create table usuario(
    id_usuario integer primary key AUTO_INCREMENT,
    name varchar(80),
    email varchar(80),
    senha varchar(80),
    confirmSenha varchar(80),
    cep varchar(80),
    data_nascimento varchar(80),
    nivel ENUM('user', 'admin') NOT NULL DEFAULT 'user'
    ) -->

    <!-- Tabela de enunciado das questões
CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL
); -->

          <!-- como inserir um admin => INSERT INTO usuario (name,email,senha,confirmSenha,cep,data_nascimento,nivel) VALUES ('calebe','cal@gmail.com',1234,1234,15770000,01032007,'admin'); -->


<!-- Tabela de alternativas
CREATE TABLE IF NOT EXISTS options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT NOT NULL,
    option_text VARCHAR(255) NOT NULL,
    career ENUM('math_teacher', 'lawyer', 'programmer') NOT NULL,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
); -->

<!-- Tabela de cursos e faculdades
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    career ENUM('math_teacher', 'lawyer', 'programmer') NOT NULL,
    course_name VARCHAR(255) NOT NULL,
    university_name VARCHAR(255) NOT NULL,
    course_url VARCHAR(255) NOT NULL
); -->

<!-- Tabela de localizações
CREATE TABLE IF NOT EXISTS locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    zip VARCHAR(10) NOT NULL,
    latitude DOUBLE NOT NULL,
    longitude DOUBLE NOT NULL,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
); -->