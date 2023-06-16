CREATE DATABASE sistema_blog;
USE sistema_blog;

CREATE TABLE usuarios
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50),
    email VARCHAR(50),
    senha VARCHAR(50)
);

CREATE TABLE app_comentarios
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    comentario VARCHAR(500),
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);
