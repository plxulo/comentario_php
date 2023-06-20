<?php
    // Conecte-se ao banco de dados
    include("conexao.php");

    $idFuncionario = $_GET['id'];

    $selecionarImagem = $pdo->prepare("SELECT imagem FROM funcionarios WHERE id = :id");
    $selecionarImagem->bindValue(":id", $idFuncionario);
    $selecionarImagem->execute();

    if ($selecionarImagem->rowCount() > 0) {
        $row = $selecionarImagem->fetch();
        $imagem = $row['imagem'];

        // Defina o cabeçalho correto para exibir a imagem
        header('Content-Type: image/jpeg');
        header('Content-Length: ' . strlen($imagem));

        // Imprima o conteúdo da imagem
        echo $imagem;
    }
?>
