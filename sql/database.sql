CREATE DATABASE sistema_blog;
USE sistema_blog;

CREATE TABLE usuarios
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50),
    email VARCHAR(50),
    senha VARCHAR(50)
);

CREATE TABLE usuarios_admin
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50),
    email VARCHAR(50),
    senha VARCHAR(50)
);

CREATE TABLE funcionarios
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50),
    imagem MEDIUMBLOB
)

CREATE TABLE app_comentarios
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    comentario VARCHAR(500),
    id_usuario INT,
    id_post INT,
    FOREIGN KEY (id_post) REFERENCES app_posts(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE app_posts
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(50),
    conteudo VARCHAR(500),
    imagem MEDIUMBLOB,
    id_admin INT,
    id_comentario INT,
    nota_post INT,
    FOREIGN KEY (id_comentario) REFERENCES app_comentarios(id),
    FOREIGN KEY (id_admin) REFERENCES usuarios_admin(id)
);

ALTER TABLE app_comentarios ADD FOREIGN KEY (id_usuario) REFERENCES usuarios(id); 
ALTER TABLE app_comentarios ADD FOREIGN KEY (id_post) REFERENCES app_posts(id);

ALTER TABLE app_posts ADD FOREIGN KEY (id_admin) REFERENCES usuarios_admin(id);
ALTER TABLE app_posts ADD FOREIGN KEY (id_comentario) REFERENCES app_comentarios(id);
