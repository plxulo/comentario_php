<?php

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

    <div align="left">
        <a href="../php/login_usuario.php">Área do Usuário</a>
    </div>
    <main align="center">
        <div class="banner">
            <h1>Login Administrador</h1>
        </div>

        <!-- Formulário de cadastro -->
        <form action="validar_admin.php" method="POST">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">
            <br>
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
            <br>

            <!-- Enviar os dados do formulário -->
            <button type="submit">Enviar</button>
        </form>
        <a href="cadastro_admin.php">Não tenho conta</a>
    </main>    
    
</body>
</html>