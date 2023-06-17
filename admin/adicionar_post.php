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
            <form action="processar_post.php" method="POST" class="frm_post" style="text-align: left;">
                <label class="texto_formulario" for="nome">Título:</label><br>
                <input type="text" class="pst_titulo" name="pst_titulo" id="titulo">
                <br>
                <label class="texto_formulario" for="email">Conteúdo:</label><br>
                <textarea class="pst_conteudo" name="pst_conteudo" id="conteudo"></textarea>
                <br>
                <input type="submit" name="pst_submit" id="pst_submit" class="pst_submit" value="Enviar post">
            </form>
        </div>

    </main>
</body>
</html>