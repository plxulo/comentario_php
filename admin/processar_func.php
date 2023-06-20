<?php
    include("../php/conexao.php");

    $nome = $_POST["nome_func"];
    $imagem = file_get_contents($_FILES['img_func']['tmp_name']);

    $inserir_func = $pdo->prepare("INSERT INTO funcionarios(nome, imagem) VALUES (?, ?)");
    $inserir_func->bindParam(1, $nome);
    $inserir_func->bindParam(2, $imagem, PDO::PARAM_LOB);
    $inserir_func->execute();

    if($inserir_func == TRUE)
    {
        header("Location: adicionar_func.php");
    }
?>