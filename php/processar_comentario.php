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
    $nome = $_POST['frm_nome'];
    $id_usuario = $_SESSION['id'];

    if((isset ($_SESSION['usuario']) == TRUE) AND (isset ($_SESSION['senha']) == TRUE))
    {
        $inserir_comentario = $pdo->prepare
        ("INSERT INTO app_comentarios (comentario, id_usuario)
          VALUES (?, ?)
        ");
        $inserir_comentario->bindParam(1, $comentario);
        $inserir_comentario->bindParam(2, $id_usuario);
        $inserir_comentario->execute();
    }

    if($inserir_comentario)
    {
        header("Location: index.php");
    }
?>