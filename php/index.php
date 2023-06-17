<?php
    include("conexao.php");
    session_start();

    if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))
    {
      header('location: login_usuario.php');
    }
  
    $logado = $_SESSION['usuario'];
    $id_usuario = $_SESSION['id'];

    $selecionar_posts = $pdo->prepare
    ("SELECT app_posts.*, usuarios_admin.nome
      FROM app_posts INNER JOIN usuarios_admin
      ON app_posts.id_admin = usuarios_admin.id
    ");
    $selecionar_posts->execute();
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
    <main style="display:flex; flex-direction:column; align-items:center">
        <div class="banner" style="display:flex; flex-direction:column; align-items:center">
            <h1>Olá, <?php echo $logado; ?>!</h1>
            <div>
                <a href="../admin/login_admin.php">Área do Administrador</a>
                <a href="logout.php">Sair</a>
            </div>
        </div>

        <div style="display:flex; flex-direction:column; align-items:center">
            <!-- Formulário de comentários: -->
            <form action="processar_comentario.php" method="POST" class="frm_comentario" style="text-align: left;">
                <label class="texto_formulario" for="nome">Nome:</label><br>
                <input type="text" class="frm_nome" name="frm_nome" id="nome">
                <br>
                <label class="texto_formulario" for="email">Email:</label><br>
                <input type="text" class="frm_email" name="frm_email" id="email">
                <br>
                <label class="texto_formulario" for="comentario">Comentário:</label><br>
                <input type="text" class="frm_comentario" name="frm_comentario" id="comentario">
                <br>
                <input type="submit" name="frm_submit" id="frm_submit" class="frm_submit" value="Comentar">
            </form>
        </div>

        <!-- Exibir posts: -->
        <div style="display:flex; flex-direction:column; width: 25%; text-align:left">
            
            <?php
                if($selecionar_posts->rowCount() == 0)
                {
                    echo("<p>Nenhum post no momento.</p>");
                }
                else
                {
                    while($row_posts = $selecionar_posts->fetch())
                    {
                        $id_post = $row_posts["id"];
                        $titulo = $row_posts["titulo"];
                        $nome_admin = $row_posts["nome"];
                        $conteudo = $row_posts["conteudo"];
                    
                        // Cada DIV é um post:
                        echo("<div>");
                            // Envolver conteúdo exibido na lista em um <a> que envia por meio da URL $_GET o valor id = $id_post
                            echo("<a style='text-decoration:none; color:black' href='pagina_post.php?id=" . $id_post . "'>");
                                echo("<h3 style='margin-bottom:0'>" . $titulo . "</h3>");
                                echo("<p style='margin-top:0'>Criador: " . $nome_admin . "</p>");
                                echo("<br>");
                                echo("<p style='margin-top:0'>" . $conteudo . "</p>");
                            echo("</a>");
                        echo("</div>");
                    }
                }
            ?>
        </div>
    </main>
</body>
</html>