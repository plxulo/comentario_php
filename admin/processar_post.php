<?php

    include("../php/conexao.php");
    session_start();

    $titulo = $_POST['pst_titulo'];
    $conteudo = $_POST['pst_conteudo'];
    $id_admin = $_SESSION['id_adm'];
    $imagem = file_get_contents($_FILES['pst_imagem']['tmp_name']);

    $id_comentario = $_POST['id_cmt'];

    $inserir_post = $pdo->prepare("INSERT INTO app_posts (titulo, conteudo, imagem, id_admin)
    VALUES (?, ?, ?, ?)");
    $inserir_post->bindParam(1, $titulo);
    $inserir_post->bindParam(2, $conteudo);
    $inserir_post->bindParam(3, $imagem, PDO::PARAM_LOB);
    $inserir_post->bindParam(4, $id_admin);
    $inserir_post->execute();

    if($inserir_post)
    {
        header("Location: adicionar_post.php");
    }
?>