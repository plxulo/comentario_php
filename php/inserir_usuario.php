<?php

    include ("conexao.php");
    session_start();

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $cep = $_POST['cep'];
    $senha = $_POST['senha'];

    $inserir = $pdo->prepare("INSERT INTO usuarios (nome, email, rua, numero, cep, senha) VALUES (?, ?, ?, ?, ?, ?)");
    $inserir->bindParam(1, $nome);
    $inserir->bindParam(2, $email);
    $inserir->bindParam(3, $rua);
    $inserir->bindParam(4, $numero);
    $inserir->bindParam(5, $cep);
    $inserir->bindParam(6, $senha);
    $inserir->execute();

    // Pegar o último ID inserido:
    $ultimo_id = $pdo->lastInsertId();
    $_SESSION['id'] = $ultimo_id;

    // Inserção funcionou:
    if ($inserir)
    {
        $_SESSION['usuario'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;

        header("Location: index.php");
    }
    else
    {
        echo "Erro ao inserir";
        header("Location: inserir_usuario.php");
    }

?>