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
            <h1>Cadastro Administrador</h1>
        </div>

        <!-- Formulário de cadastro -->
        <form action="inserir_admin.php" method="POST">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">
            <br>
            <label for="email">Email</label>
            <input type="mail" name="email" id="email">
            <br>
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
            <br>

            <!-- Enviar os dados do formulário -->
            <button type="submit">Enviar</button>
        </form>
        <a href="login_admin.php">Já tenho conta</a>
    </main>    

</body>
</html>