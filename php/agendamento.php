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
    <title>agendamento</title>
</head>

<style>
    .escondido {
        display: none;
    }
</style>

<body>

    <main style="display:flex; flex-direction:column; align-items:center; gap:10px;">
        <div class="banner" style="display:flex; flex-direction:column; align-items:center; gap:10px;">
            <h1>Olá <?php echo $logado; ?>!</h1>
            <a href="index.php">Home</a>
            <a href="../admin/index_admin.php">Área do Administrador</a>
            <a href="logout.php">Sair</a>
        </div>

        <div style="display:flex; flex-direction:column;align-items:left">
            <hr width="100%">
            <button id="agendamento_comercial" onclick="agendamento_comercial()">Agendar na barbearia</button>
            <button id="agendamento_casa" onclick="agendamento_casa()">Agendar para casa</button>
            <hr width="100%">
            <form action="processar_agendamento.php" method="POST" style="display: flex; flex-direction:column; gap:10px;">
                <input type="text" placeholder="Seu nome" name="frm_usuario">
                <input type="email" placeholder="Email" name="frm_email">
                <input type="date" name="data_agendamento">
                <input class="escondido" type="text" placeholder="Local de agendamento" name="local_agendamento" id="local_agendamento">
                <select class="escondido" name="local_comercial" id="local_comercial">
                    <?php
                        $id_post = $_SESSION["id_post"];
                        $selecionar_local = $pdo->prepare("SELECT * FROM app_posts WHERE id = $id_post");
                        $selecionar_local->execute();

                        if($selecionar_local->rowCount() == 0)
                        {
                            echo("<option>Nenhum local disponível</option>");
                        }
                        
                        while($linhas_local = $selecionar_local->fetch())
                        {
                            $id = $linhas_local["id"];
                            $nome = $linhas_local["titulo"];
                            echo("<option value='$id'> $nome </option>");
                        }
                    ?>
                </select>
                <select name="pagamento" id="selecionar_pagamento">
                    <option value="dinheiro">Dinheiro</option>
                    <option value="cartao_debito">Cartão Débito</option>
                    <option value="cartao_credito">Cartão Crédito</option>
                    <option value="cheque">PIX</option>
                </select>
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
        </div>
    </main>
</body>
<script>
    var inputLocalAgendamento = document.getElementById("local_agendamento");
    var selectLocalComercial = document.getElementById("local_comercial");
    function agendamento_casa() {
        // Oculta o campo do local comercial
        selectLocalComercial.style.display = "none";

        // Exibe o campo do local de agendamento
        inputLocalAgendamento.style.display = "flex";
    }

    function agendamento_comercial() {
        // Oculta o campo do local de agendamento
        inputLocalAgendamento.style.display = "none";

        // Exibe o campo do local comercial
        selectLocalComercial.style.display = "flex";
    }

</script>
</html>