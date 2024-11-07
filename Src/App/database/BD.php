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












<!-- inserções -->

INSERT INTO carreira (nome) VALUES 
('Desenvolvedor de Software'),
('Designer Gráfico'),
('Gerente de Projetos'),
('Analista de Sistemas');

INSERT INTO cep (cep_numero) VALUES 
('15775-000'),
('15770-000'),
 ('15700-000'),
('15773-000'); 

INSERT INTO usuario (name, email, senha, id_cep, data_nascimento, nivel) VALUES 
('João', 'joao@gmail.com', '111', 1, '1990-05-15', 'user'),
('adm', 'adm@gmail.com', '123', 2, '1995-08-25', 'admin');


INSERT INTO questions (question_text) VALUES 
('Qual a sua área de atuação?'),
('Qual a sua experiência com programação?'),
('Você tem interesse em trabalhar em grandes empresas?');

INSERT INTO options (question_id, option_text, carreira_id) VALUES 
(1, 'Desenvolvimento de Software', 1),
(1, 'Design Gráfico', 2),
(1, 'Gestão de Projetos', 3),
(1, 'Projetos web ads', 4),
(2, 'Programação Web', 1),
(2, 'Design Gráfico Digital', 2),
(2, 'Projetos web ads', 4),
(2, 'Projetos web ads', 4),
(3, 'Sim, eu gosto de trabalhar em empresas grandes', 1),
(3, 'Projetos web ads', 4),
(3, 'Projetos web ads', 4),
(3, 'Projetos web ads', 4);

INSERT INTO instituicao (nome_fantasia, id_cep, cnpj, email, senha, url, razao_social) VALUES 
('Tech School', 1, '12345678000199', 'p@gmail.com', 'senha1', 'https://www.techschool.com', 'Tech School LTDA'),
('Design Academy', 2, '98765432000188', 's@gmail.com', 'senha2', 'https://www.designacademy.com', 'Design Academy LTDA');


INSERT INTO cursos (id_instituicao, nome_curso, foto_curso, duracao, descricao, carreira_id) VALUES 
(1, 'Desenvolvimento Web', 'web_course.jpg', '6 meses', 'Curso de desenvolvimento web com foco em front-end e back-end', 1),
(2, 'Design Gráfico Avançado', 'design_course.jpg', '8 meses', 'Curso completo de design gráfico com ênfase em ferramentas digitais', 2);

INSERT INTO curriculos (nome, foto_perfil, endereco, email, telefone, experiencia, formacao, habilidades) VALUES 
('João Silva', 'joao_perfil.jpg', 'Rua A, 123', 'joao.silva@example.com', '(11) 99999-9999', 'Desenvolvedor de sistemas em Java e PHP', 'Bacharelado em Ciência da Computação', 'Java, PHP, SQL, Git'),
('Maria Oliveira', 'maria_perfil.jpg', 'Rua B, 456', 'maria.oliveira@example.com', '(11) 98888-8888', 'Designer gráfico com 5 anos de experiência', 'Tecnólogo em Design Gráfico', 'Photoshop, Illustrator, Figma');

INSERT INTO instituicao_cep_proximo (id_usuario, id_instituicao, cep_id, proximidade) VALUES 
(1, 1, 1, TRUE),
(1, 2, 2, FALSE),
(2, 1, 2, TRUE),
(2, 2, 1, FALSE);
