<?php
    include("../php/conexao.php");
    session_start();

    if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))
    {
      header('location: login_admin.php');
    }
  
    $logado = $_SESSION['usuario'];
    $id_usuario = $_SESSION['id_adm'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    <main align="center">
        <div class="banner" style="display:flex; flex-direction:column; align-items:center; gap:10px;">
            <h1>Olá Administrador, <?php echo $logado; ?>!</h1>
            <a href="index_admin.php">Home</a>
            <a href="../php/login_usuario.php">Área do Usuário</a>
            <a href="adicionar_post.php">Adicionar Post</a>
            <a href="adicionar_func.php">Adicionar Funcionário</a>
            <a href="logout.php">Sair</a>
        </div>

        <div class="local_cliente" style="display:flex; flex-direction:column; align-items:center">
            <?php

                $selecionar_agendamentos = $pdo->prepare("SELECT app_agendamentos.*, funcionarios.nome AS nome_funcionario, usuarios.nome AS nome_cliente, id
                                                FROM app_agendamentos
                                                INNER JOIN funcionarios ON app_agendamentos.funcionario = funcionarios.id
                                                INNER JOIN usuarios ON app_agendamentos.cliente = usuarios.id");
                $selecionar_agendamentos->execute();
            ?>
        </div>
    </main>
</body>
</html>