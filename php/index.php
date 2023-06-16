<?php
    session_start();

    if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))
    {
      header('location: login_usuario.php');
    }
  
    $logado = $_SESSION['usuario'];
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
            <h1>Olá, <?php echo $logado; ?>!</h1>
            <a href="logout.php">Sair</a>
        </div>
    </main>    
    
</body>
</html>