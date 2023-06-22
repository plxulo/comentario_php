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
        <div class="banner" style="display:flex; flex-direction:column; align-items:center; gap:10px;">
            <h1>Olá Administrador, <?php echo $logado; ?>!</h1>
            <a href="index_admin.php">Home</a>
            <a href="../php/login_usuario.php">Área do Usuário</a>
            <a href="adicionar_post.php">Adicionar Post</a>
            <a href="adicionar_func.php">Adicionar Funcionário</a>
            <a href="logout.php">Sair</a>
        </div>

        <div class="agendamentos" style="display:flex; flex-direction:column; align-items:center">
            <?php

                $selecionar_agendamentos = $pdo->prepare("SELECT app_agendamentos.*, funcionarios.nome AS nome_funcionario, usuarios.nome AS nome_cliente
                                                FROM app_agendamentos
                                                INNER JOIN funcionarios ON app_agendamentos.funcionario = funcionarios.id
                                                INNER JOIN usuarios ON app_agendamentos.cliente = usuarios.id");
                $selecionar_agendamentos->execute();
                if($selecionar_agendamentos->rowCount() == 0)
                {
                    echo("<p>Nenhum agendamento no momento</p>");
                }
                else
                {
                    while($row_agendamento = $selecionar_agendamentos->fetch())
                    {
                        $cliente_id = $row_agendamento["id"];
                        $cliente = $row_agendamento["nome_cliente"];
                        $funcionario = $row_agendamento["nome_funcionario"];
                        $data = $row_agendamento["data_agendamento"];
                        $local = $row_agendamento["local_agendamento"];
                        echo
                        ("
                            <table border='solid, 1px'>
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Funcionário</th>
                                        <th>Data</th>
                                        <th>Local</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>$cliente</td>
                                        <td>$funcionario</td>
                                        <td>$data</td>
                                        <td>$local</td>
                                        <td><a>Excluir</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        ");
                            //echo("<p style='margin-bottom:0'>Cliente: " . $cliente . "</p>");
                            //echo("<p style='margin-bottom:0'>Funcionário: " . $funcionario . "</p>");
                            //echo("<p style='margin-bottom:0'>Data: " . $data . "</p>");
                    }
                }
            ?>
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