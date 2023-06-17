<?php

    include("../php/conexao.php");
    session_start();

    if(isset($_SESSION['usuario']))
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $deletar_comentario = $pdo->prepare("DELETE FROM app_comentarios WHERE id = '$id'");
            $deletar_comentario->execute();

            header("Location: index_admin.php");
        }
        else
        {
            echo("ID não fornecido");
            header("Location: index_admin.php");
        }
    }
    else
    {
        header("Location: login_admin.php");
    }
?>