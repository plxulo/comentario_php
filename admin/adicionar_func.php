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
        <div class="banner">
            <h1>Olá Administrador, <?php echo $logado; ?>!</h1>
            <a href="../php/login_usuario.php">Área do Usuário</a>
            <a href="adicionar_post.php">Adicionar Post</a>
            <a href="logout.php">Sair</a>
        </div>

        <div style="display:flex; flex-direction:column; align-items:center">
            <!-- Formulário de comentários: -->
            <form action="processar_func.php" method="POST" class="frm_post" style="text-align: left;" enctype="multipart/form-data">
                <label for="nome_func">Nome do funcionário:</label>
                <input type="text" id="nome_func" name="nome_func">
                <br>
                <label for="img_func">Foto do funcionário:</label>
                <input type="file" id="img_func" name="img_func">
                <br>
                <input type="submit">
            </form>
        </div>

    </main>
</body>
</html>