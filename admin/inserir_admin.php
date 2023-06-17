<?php

    include("../php/conexao.php");
    session_start();

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $inserir = $pdo->prepare("INSERT INTO usuarios_admin (nome, email, senha) VALUES (?, ?, ?)");
    $inserir->bindParam(1, $nome);
    $inserir->bindParam(2, $email);
    $inserir->bindParam(3, $senha);
    $inserir->execute();

    // Pegar o último ID inserido:
    $ultimo_id = $pdo->lastInsertId();
    $_SESSION['id_adm'] = $ultimo_id;

    // Inserção funcionou:
    if ($inserir)
    {
        $_SESSION['usuario'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;

        header("Location: index_admin.php");
    }
    else
    {
        echo "Erro ao inserir";
        header("Location: inserir_admin.php");
    }

?>