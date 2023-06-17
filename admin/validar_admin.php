<?php
    include("../php/conexao.php");
    session_start();
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $consultar = $pdo->prepare("SELECT * FROM usuarios_admin WHERE nome = :nome AND senha = :senha");
    $consultar->bindParam(':nome', $nome);
    $consultar->bindParam(':senha', $senha);
    $consultar->execute();

    $pegar_id = $consultar->fetch(PDO::FETCH_ASSOC);
    $id = $pegar_id['id'];

    if($consultar->rowCount() > 0)
    {
        $_SESSION['usuario'] = $nome;
        $_SESSION['senha'] = $senha;
        $_SESSION['id_adm'] = $id;
        header('location:index_admin.php');
    }
    else
    {
        echo("Usuário ou senha incorretos");
        header('location:login_usuario.php');
    }

?>