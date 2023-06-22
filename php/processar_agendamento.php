<?php
    include("conexao.php");
    session_start();

    $data_agendamento = $_POST["data_agendamento"];
    $local_agendamento = $_POST["local_agendamento"];
    $cliente = $_POST["frm_usuario"];
    $email_cliente = $_POST["frm_email"];
    $funcionario = $_POST["selecionar_func"];
    $id_cliente = $_SESSION['id'];

    $agendar = $pdo->prepare("INSERT INTO app_agendamentos (data_agendamento, cliente, email_cliente, funcionario, local_agendamento)
                              VALUES (?, ?, ?, ?, ?)");
    $agendar->bindParam(1, $data_agendamento);
    $agendar->bindParam(2, $id_cliente);
    $agendar->bindParam(3, $email_cliente);
    $agendar->bindParam(4, $funcionario);
    $agendar->bindParam(5, $local_agendamento);
    $agendar->execute();

    if($agendar) 
    {
        header("Location: agendamento.php");
    }

?>