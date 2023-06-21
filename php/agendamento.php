<?php
    include("conexao.php");
    session_start();

    if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))
    {
      header('location: login_usuario.php');
    }

    $logado = $_SESSION["usuario"];
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
            <div align="center">
                <a href="index.php"><-Voltar</a>
                <a href="../admin/login_admin.php">Área do Administrador</a>
                <a href="logout.php">Sair</a>
            </div>
        </div>
        <div style="display:flex; flex-direction:column;align-items:left">
            <form action="processar_agendamento.php" method="POST">
                <input type="text" placeholder="Seu nome" name="frm_usuario">
                <br>
                <input type="email" placeholder="Email" name="frm_email">
                <br>
                <input type="date" name="data_agendamento">
                <br>
                <select id="selecionar_func" name="selecionar_func">
                    <?php

                        $selecionar_func = $pdo->prepare("SELECT * FROM funcionarios");
                        $selecionar_func->execute();

                        if($selecionar_func->rowCount() == 0)
                        {
                            echo("<option>Nenhum funcionário cadastrado</option>");
                        }

                        while($linhas_func = $selecionar_func->fetch())
                        {
                            $id_func = $linhas_func["id"];
                            $nome_func = $linhas_func["nome"];
                            echo("<option value='$id_func'> Funcionário: " . $nome_func . "</option>");
                        }
                    ?>
                </select>
                <input type="submit">
            </form>
            <div id="imagemFuncionario" width="200px" height="200px"></div>
        </div>
    </main>

</body>
</html>