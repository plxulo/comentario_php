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
            <form action="processar_comentario_adm.php" method="POST" class="frm_comentario" style="text-align: left;">
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

        <div>
            <?php
                // Selecionar o nome do usuário que enviou comentário por chave estrangeira:
                $selecionar_comentario = $pdo->prepare
                ("SELECT app_comentarios.*, usuarios.nome 
                FROM app_comentarios INNER JOIN usuarios 
                ON app_comentarios.id_usuario = usuarios.id 
                ");
                $selecionar_comentario->execute();

                if($selecionar_comentario->rowCount() == 0)
                {
                    echo("<p>Nenhum comentário no momento.</p>");
                }
                else
                {
                    while($row_comentario = $selecionar_comentario->fetch())
                    {
                        // Caso deseje exibir o nome do usuário na sessão sem definir
                        // Uma entrada de input "nome" para o mesmo, utilize a tabela e sessão.
                        $nome = $row_comentario["nome"];

                        // Nesse caso, como eu possuo uma entrada para o nome e desejo exibir
                        // O nome de cada entrada, eu utilizarei o seguinte código
                        // Para atribuir o valor da entrada nome para a variável e exibi-lá:
                        $comentario = $row_comentario["comentario"];

                        echo("<h2 style='margin-bottom:0'>" . $nome . "</h2>");
                        echo("<br>");
                        echo("<p style='margin-top:0'>" . $comentario . "</p> <a href='excluir_comentario.php?id=" . $row_comentario["id"] . "'>Excluir</a>");
                    }
                }
            ?>
        </div>

    </main>
</body>
</html>