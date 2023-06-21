<?php
include('conexao.php');
session_start();

$id_post = $_SESSION["id_post"];

if (isset($_POST['valorSlider'])) {
    $valorSlider = $_POST['valorSlider'];
  
    // Insira o valor no banco de dados
    $inserir_valor = $pdo->prepare("UPDATE app_posts SET nota_post = :nota WHERE id = $id_post");
    $inserir_valor->bindValue(':nota', $valorSlider);
    $inserir_valor->execute();
  
    // Verifique se a inserção foi bem-sucedida
    if ($inserir_valor->rowCount() > 0) {
      echo "Valor do slider inserido com sucesso.";
    } else {
      echo "Falha ao inserir o valor do slider.";
    }
  }

?>