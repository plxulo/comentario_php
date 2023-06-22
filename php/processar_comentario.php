<?php
    /*
        Este bloco de código insere comentários na tabela comentários
        Para selecioná-los depois no arquivo index.php e exibi-los
        Na página. A tabela tem chave estrangeira id_usuario, pois desejo
        Separar no banco de dados para não poluir a tabela usuários.
    */

    include("conexao.php");
    session_start();

    $comentario = $_POST['frm_comentario'];
    $id_usuario = $_SESSION['id'];
    $id_post_atual = $_SESSION['id_post'];

    $selecionar_posts = $pdo->prepare
    ("SELECT * FROM app_posts WHERE id = $id_post_atual");
    $selecionar_posts->execute();
    $post = $selecionar_posts->fetch();
    
    $id_post = $post['id'];

    if((isset ($_SESSION['usuario']) == TRUE) AND (isset ($_SESSION['senha']) == TRUE))
    {
        $inserir_comentario = $pdo->prepare
        ("INSERT INTO app_comentarios (comentario, id_usuario, id_post)
          VALUES (?, ?, ?)
        ");
        $inserir_comentario->bindParam(1, $comentario);
        $inserir_comentario->bindParam(2, $id_usuario);
        $inserir_comentario->bindParam(3, $id_post);
        $inserir_comentario->execute();
    }

    // Atualizar a página mantendo o ID post para que o post seja exibido corretamente.
    if($inserir_comentario)
    {
        header("Location: pagina_post.php?id=$id_post");
    }
?>